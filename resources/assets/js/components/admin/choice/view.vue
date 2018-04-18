<template>
    <div>
        <div class="card card-default mb-3" v-if="form">
            <div class="card-header">
                รายละเอียดตัวเลือก
                <span v-if="parent">{{parent.name}} \ </span>
                {{form.name}}
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">

                        <tbody>
                        <tr>
                            <th class="w-25">ชื่อตัวเลือก (Unique)</th>
                            <td>{{form.name}}</td>
                        </tr>
                        <tr>
                            <th>ชื่อแสดง</th>
                            <td>{{form.display_name}}</td>
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            <td>{{form.description}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card card-default mb-3" v-if="form">
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

                        <router-link v-if="form.parent"
                                     :key="$route.fullPath"
                                     :to="{ name: 'choice-view', params: { id: form.parent.id }}"
                                     class="btn btn-light">
                            ย้อนกลับ
                        </router-link>

                        <router-link v-else
                                     :key="$route.fullPath"
                                     :to="{ name: 'choice-home'}"
                                     class="btn btn-light">
                            ย้อนกลับ
                        </router-link>
                    </div>
                    <div class="col-lg">
                        <div class="float-lg-right float-sm-left">

                        </div>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>ชื่อตัวเลือก (Unique)</th>
                            <th>ชื่อแสดง</th>
                            <th>รายละเอียด</th>
                            <template v-for="(value,key) in children_fields">
                                <th v-if="value.showInTable">{{value.display_name}}</th>
                            </template>

                            <th>การกระทำ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in form.children">
                            <td>{{item.name}}</td>
                            <td>{{item.display_name}}</td>
                            <td>{{item.description}}</td>
                            <template v-for="(value,key) in children_fields">
                                <th v-if="value.showInTable">
                                    <template v-if="value.type=='ref'">{{item.values[key].display_name}}</template>
                                    <template v-else>
                                        <template v-if="item.values && item.values.hasOwnProperty(key)">
                                            {{item.values[key]}}
                                        </template>
                                    </template>
                                </th>
                            </template>
                            <td>
                                <div class="btn-group">
                                    <router-link :to="{ name: 'choice-view', params: { id: item.id }}"
                                                 class="btn btn-info">
                                        รายละเอียด
                                    </router-link>
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

    </div>
</template>

<script>
    import ChoiceService from "../../../services/ChoiceService";
    import ChoiceSelect from "../choice/choiceSelect";

    export default {
        components: {
            ChoiceSelect
        },
        data() {
            return {
                children_fields: [],
                parent: null,
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
            updateField: function ($event, key) {
                console.log($event, key);
                this.form.values[key] = $event;
            },
            load: function () {
                let self = this;
                ChoiceService.getById(self.$route.params.id)
                    .then((r) => {
                        let data = r.data;
                        self.form = data;
                        self.parent = data.parent;
                        self.children_fields = data.children_fields;

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