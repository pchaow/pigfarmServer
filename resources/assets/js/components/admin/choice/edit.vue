<template>
    <div>
        <div class="card card-default mb-3" v-if="form">
            <div class="card-header">
                แก้ไขตัวเลือก
                <span v-if="parent">{{parent.name}} \ </span>
                {{form.name}}
            </div>
            <div class="card-body">
                <form v-on:submit.default="save">
                    <fieldset>
                        <legend>รายละเอียด</legend>
                        <input-group v-model="form.name" :error="error" display-name="ชื่อตัวเลือก (Unique)"
                                     type="text" errorkey="name" placeholder="Enter Name (unique)">
                        </input-group>

                        <input-group v-model="form.display_name" :error="error" display-name="ชื่อแสดง"
                                     type="text" errorkey="display_name" placeholder="Enter Display Name">
                        </input-group>

                        <input-group v-model="form.description" :error="error" display-name="รายละเอียด"
                                     type="text" errorkey="description" placeholder="Enter Description">
                        </input-group>


                        <template v-if="parent">
                            <template v-for="(value,key) in parent.children_fields">
                                <div class="form-group">
                                    <label>{{value.display_name}}</label>
                                    <input v-if="value.type == 'text'" v-model="form.values[key]" type="text"
                                           class="form-control"
                                           placeholder="Placeholder">
                                    <input v-if="value.type == 'number'" v-model="form.values[key]" type="number"
                                           class="form-control"
                                           placeholder="Placeholder">

                                    <choice-select v-if="value.type == 'ref'" @change="updateField($event,key)"
                                                   :type="value"
                                                   :value="form.values[key]"></choice-select>
                                </div>
                            </template>
                        </template>

                        <div class="form-group">
                            <label>Children Field</label>

                            <table class="table table-bordered">
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
                                    <td><input v-model="children_forms.key" class="form-control" type="text"/></td>
                                    <td><input v-model="children_forms.display_name" class="form-control" type="text"/>
                                    </td>
                                    <td style="width:100px;">
                                        <select v-model="children_forms.type" class="form-control">
                                            <option disabled value="">Please select one</option>
                                            <option selected>text</option>
                                            <option>number</option>
                                            <option>ref</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input v-model="children_forms.to" class="form-control" type="text"/>
                                    </td>
                                    <td>
                                        <input v-model="children_forms.showInTable" class="form-control" type="text"/>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" @click="addChildrenFields">
                                                เพิ่ม
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <router-link class="btn btn-light" v-if="$route.params.back_to"
                                 :to="$route.params.back_to"
                    >
                        ยกเลิก
                    </router-link>

                    <router-link v-else-if="form.parent"
                                 :key="$route.fullPath"
                                 :to="{ name: 'choice-view', params: { id: form.parent.id }}"
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
                error: {},
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
                        this.error = e.response.data.errors
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