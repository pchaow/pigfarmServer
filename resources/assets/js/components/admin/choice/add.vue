<template>
    <div v-if="isLoaded">
        <div class="headline pb-3">เพิ่มตัวเลือก
        </div>

        <v-layout column justify-center>
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
                                <v-text-field :label="value.display_name" v-if="value.type == 'text'"
                                              v-model="form.values[key]" type="text"/>
                                <v-text-field :label="value.display_name" v-if="value.type == 'number'"
                                              v-model="form.values[key]" type="number"/>

                                <choice-select v-if="value.type == 'ref'" @change="updateField($event,key)"
                                               :type="value"
                                               :value="form.values[key]"></choice-select>
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
                                    <td>
                                        <v-text-field v-model="children_forms.key" label="Key" type="text"/>
                                    </td>
                                    <td>
                                        <v-text-field v-model="children_forms.display_name" label="Display Name"
                                                      type="text"/>
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

                                        <v-text-field :disabled="children_forms.type != 'ref'"
                                                      v-model="children_forms.to" type="text"/>
                                    </td>
                                    <td>
                                        <v-switch
                                                v-model="children_forms.showInTable"
                                        ></v-switch>
                                    </td>
                                    <td>
                                        <v-btn color="primary" type="button" @click="addChildrenFields">
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

    import ChoiceService from "../../../services/ChoiceService"
    import ChoiceSelect from "./choiceSelect";
    import InputGroup from "../../forms/input-group";

    export default {
        components: {ChoiceSelect, InputGroup},
        data() {
            let self = this;
            let parent_id = self.$route.params.id;

            return {
                isLoaded: false,
                parent: null,
                form: {
                    parent_name: parent_id,
                    children: [],
                    values: {},
                },
                error: {
                    errors: {},
                    message: null,
                },
                children_forms: {
                    type: 'text'
                },

            }

        },
        methods: {

            addChildrenFields: function () {

                let cf = this.form.children_fields;
                let form = this.children_forms;
                console.log(form);
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
                if (this.$route.params.id) {
                    let req = ChoiceService.getById(this.$route.params.id, {});
                    req.then((r) => {
                        this.parent = r.data;
                        this.form.parent_name = this.parent.name
                        this.isLoaded = true;
                    })
                } else {
                    this.isLoaded = true;
                }
            },
            save: function () {
                console.log(this.form)
                this.error = {
                    errors: {},
                    message: null,
                }
                let req = ChoiceService.store(this.form);
                req.then((r) => {
                    if (this.parent && this.parent.hasOwnProperty('id')) {
                        this.$router.push({name: "choice-view", params: {id: this.parent.id}})
                    } else {
                        this.$router.push({name: "choice-home"})
                    }

                })
                req.catch((e) => {
                    console.log(e.response)
                    this.error = e.response.data
                });
            }
        },
        created() {
            this.load();
        },
        mounted() {
        }
    }
</script>