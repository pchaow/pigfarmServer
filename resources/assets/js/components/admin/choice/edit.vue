<template>
    <div>
        <div class="card card-default mb-3" v-if="form">
            <div class="card-header">
                แก้ไขตัวเลือก
                <span v-if="form.parent">{{form.parent.name}} \ </span>
                {{form.name}}
            </div>

            <div class="card-body">
                <form v-on:submit.default="save">
                    <fieldset>
                        <legend>รายละเอียด</legend>
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" class="form-control"
                                   placeholder="Choice's name must be unique">
                        </div>
                        <div class="form-group">
                            <label>Display Name</label>
                            <input v-model="form.display_name" type="text" class="form-control"
                                   placeholder="Enter Display Name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="text" class="form-control"
                                   placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label>Children Field</label>
                            <textarea class="form-control" v-model="form.children_fields"></textarea>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-primary">Submit</button>

                    <router-link v-if="form.parent"
                                 :key="$route.fullPath"
                                 :to="{ name: 'choice-edit', params: { id: form.parent.id }}"
                                 class="btn btn-light">
                        ยกเลิก
                    </router-link>

                    <router-link v-else
                                 :key="$route.fullPath"
                                 :to="{ name: 'choice-home'}"
                                 class="btn btn-light">
                        ยกเลิก
                    </router-link>


                </form>
            </div>
        </div>


        <div class="card card-default mb-3">
            <div class="card-header">
                ตัวเลือกย่อย
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <router-link
                                :to="{ name: 'choice-children-add',params : {id :form.id}}"
                                class="btn btn-primary">
                            เพิ่มรายการย่อย
                        </router-link>
                    </div>
                    <div class="col-lg">
                        <div class="float-lg-right float-sm-left">

                        </div>

                    </div>
                </div>
                <table class="table table-hover table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>การกระทำ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in form.children">
                        <td>{{item.name}}</td>
                        <td>{{item.display_name}}</td>
                        <td>{{item.description}}</td>
                        <td>
                            <div class="btn-group">
                                <router-link
                                        :key="$route.fullPath"
                                        :to="{ name: 'choice-edit', params: { parent : form.id,id: item.id }}"
                                        class="btn btn-light">
                                    แก้ไข
                                </router-link>
                                <button v-on:click="destroy(item)" class="btn btn-danger">ลบ</button>

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    import ChoiceService from "../../../services/ChoiceService";

    export default {
        components: {},
        data() {
            return {
                form: {
                    children: [],
                },
            }

        },
        watch: {
            '$route'(to, from) {
                // Whatever you need to change route
                this.load();
            }
        },
        methods: {
            load: function () {
                let self = this;
                ChoiceService.getById(self.$route.params.id)
                    .then((r) => {
                        self.form = r.data
                    })
            },
            save: function () {
                let self = this
                ChoiceService.update(this.form, self.$route.params.id)
                    .then((r) => {
                        self.$router.back();
                    })
                    .catch((e) => {
                        // TODO : handle errors
                    })
            },
            destroy: function (item) {
                ChoiceService.destroy(item.id)
                    .then((r) => {
                        this.load();
                    })
                    .catch((e) => {
                        // TODO : Show error message
                    })

            }
        },
        created() {

        },
        mounted() {
            this.load();
        }
    }
</script>