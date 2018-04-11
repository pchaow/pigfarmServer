<template>
    <div>
        <div class="card card-default mb-3" v-if="form">
            <div class="card-header">แก้ไขตัวเลือก {{form.name}}</div>

            <div class="card-body">
                <form v-on:submit.default="save">
                    <fieldset>
                        <legend>ข้อมูลพื้นฐาน</legend>
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label>Display Name</label>
                            <input v-model="form.display_name" type="text" class="form-control"
                                   placeholder="Enter Choicename">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="email" class="form-control"
                                   placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>Children Field</label>
                            <textarea class="form-control" v-model="form.children_fields"></textarea>
                        </div>


                    </fieldset>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>


        <div class="card card-default mb-3" v-if="form.children && form.children.length != 0">
            <div class="card-header">
                ตัวเลือกย่อย
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
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
                                        :to="{ name: 'choice-children-edit', params: { parent : form.id,id: item.id }}"
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
            }
        },
        created() {

        },
        mounted() {
            this.load();
        }
    }
</script>