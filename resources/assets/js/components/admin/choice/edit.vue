<template>
    <div v-if="form">
        <div class="headline pb-3">แก้ไข
            <span v-if="parent">{{parent.name}} \ </span>
            {{form.name}}
        </div>

        <v-layout column justify-center >
            <v-flex>
                <v-card class="mb-3">
                    <v-card-title>
                        <h2 class="title">รายละเอียด</h2>
                    </v-card-title>
                    <v-card-text>

                        <v-text-field label="ชื่อตัวเลือก (Unique)" v-model="form.name"
                                      :error-messages="error.errors.name"/>

                        <v-text-field label="ชื่อแสดง" v-model="form.display_name"
                                      :error-messages="error.errors.display_name"/>

                        <v-text-field label="รายละเอียด" v-model="form.description"
                                      :error-messages="error.errors.description"/>


                        <template v-if="parent">
                            <template v-for="(value,key) in parent.children_fields">
                                <div class="form-group">
                                    <label>{{value.display_name}}</label>
                                    <v-text-field :label="value.display_name" v-if="value.type == 'text'" v-model="form.values[key]" type="text"/>
                                    <v-text-field :label="value.display_name" v-if="value.type == 'number'" v-model="form.values[key]" type="number"/>

                                    <choice-select v-if="value.type == 'ref'" @change="updateField($event,key)"
                                                   :type="value"
                                                   :value="form.values[key]"></choice-select>
                                </div>
                            </template>
                        </template>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn @click="save()" color="primary">Submit</v-btn>
                    </v-card-actions>
                </v-card>
                <v-card>
                    <v-card-title>
                        <h2 class="title">ข้อมูลเพิ่มเติมตัวเลือกลูก</h2>
                    </v-card-title>
                    <v-card-text>
                        <div class="">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Key</th>
                                <th>Display Name</th>
                                <th>Type</th>
                                <th>To</th>
                                <th>Show in Table</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(value,key) in form.children_fields">
                                <td>{{key}}</td>
                                <td>{{value.display_name}}</td>
                                <td>{{value.type}}</td>
                                <td>{{value.to}}</td>
                                <td>{{value.showInTable}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" @click="removeChildren(key)" class="btn btn-danger">
                                            ลบ
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><v-text-field v-model="children_forms.key" label="Key" type="text"/></td>
                                <td><v-text-field v-model="children_forms.display_name" label="Display Name" type="text"/>
                                </td>
                                <td>
                                    <v-select
                                            :items="['text','number','ref']"
                                            v-model="children_forms.type"
                                            label="Type"
                                            single-line
                                    ></v-select>
                                </td>
                                <td>

                                    <v-text-field :disabled="children_forms.type != 'ref'" v-model="children_forms.to" type="text"/>
                                </td>
                                <td>
                                    <v-switch
                                            v-model="children_forms.showInTable"
                                    ></v-switch>
                                </td>
                                <td>
                                        <v-btn color="primary" type="button"  @click="addChildrenFields">
                                            เพิ่ม
                                        </v-btn>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <v-divider/>

                    </v-card-text>
                    <v-card-actions>
                        <v-btn @click="save()" color="primary">Submit</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    import ChoiceService from "../../../services/ChoiceService";
    import ChoiceSelect from "../choice/choiceSelect";
    import InputGroup from "../../forms/input-group";

    export default {
        components: {
            InputGroup,
            ChoiceSelect,
        },
        data() {
            return {
                children_fields: [],
                parent: null,
                children_forms: {
                    type: 'text'
                },
                form: null,
                error: {
                    errors: {},
                    message: null,
                },
            }

        },
        watch: {
            '$route'(to, from) {
                // Whatever you need to change route
                this.load();
            },
        },
        methods: {
            removeChildren: function (key) {
                Vue.delete(this.form.children_fields, key)
                console.log(key);
                console.log(this.form.children_fields)
            },
            addChildrenFields: function () {

                let cf = this.form.children_fields;
                let form = this.children_forms;
                console.log(form);
                console.log(cf);
                cf[form.key] = {
                    display_name: form.display_name,
                    type: form.type,
                    to: form.to,
                    showInTable: form.showInTable,
                }

                this.children_forms = {}
            },
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
                        if (this.form.values.length === 0) {
                            this.form.values = {};
                        }
                        self.parent = data.parent;

                    })
            },
            save: function () {
                let self = this

                ChoiceService.update(this.form, this.$route.params.id)
                    .then((r) => {
                        if (this.$route.params.back_to != null) {
                            this.$router.push(this.$route.params.back_to);
                        }
                        else if (this.parent) {
                            this.$router.push({name: "choice-view", params: {id: this.parent.id}})
                        } else {
                            this.$router.push({name: "choice-home"})
                        }
                    })
                    .catch((e) => {
                        // TODO : handle errors
                        this.error = e.response.data
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

            console.log(this.$route.params.back_to)
        }
    }
</script>