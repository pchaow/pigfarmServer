<template>
    <div class="card card-default mb-3" v-if="isLoaded">
        <div class="card-header">

            <span v-if="parent">เพิ่มข้อมูลย่อย - {{parent.name}} - {{parent.display_name}}</span>
            <span v-else>เพิ่มข้อมูลพื้นฐาน</span>
        </div>

        <div class="card-body">
            <form v-on:submit.default="save">
                <fieldset>
                    <legend>รายละเอียด</legend>
                    <input type="hidden" v-model="form.parent_id"/>
                    <div class="form-group">
                        <label>ชื่อตัวเลือก (Unique)</label>
                        <input v-model="form.name" type="text" class="form-control"
                               placeholder="Choice's name must be unique">
                    </div>
                    <div class="form-group">
                        <label>ชื่อแสดง</label>
                        <input v-model="form.display_name" type="text" class="form-control"
                               placeholder="Enter Display Name">
                    </div>
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <input v-model="form.description" type="text" class="form-control"
                               placeholder="Enter Description">
                    </div>
                    <template v-if="parent">
                        <template v-for="(value,key) in parent.children_fields">
                            <div class="form-group">
                                <label>{{value.display_name}}</label>

                                <input v-if="value.type == 'text'" v-model="form.values[key]" type="text"
                                       class="form-control"
                                       placeholder="Placeholder">
                                <input v-if="value.type == 'number'" v-model="form.values[key]" type="number"
                                       class="form-control"
                                       :placeholder="value.display_name">

                                <choice-select v-if="value.type =='ref'" @change="updateField($event,key)"
                                               :type="value"></choice-select>

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

                <router-link v-if="parent.id"
                             :key="$route.fullPath"
                             :to="{ name: 'choice-view', params: { id: parent.id }}"
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
</template>

<script>

    import ChoiceService from "../../../services/ChoiceService"
    import ChoiceSelect from "./choiceSelect";

    export default {
        components: {ChoiceSelect},
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
                let self = this
                if (self.$route.params.id) {
                    ChoiceService.getById(self.$route.params.id, {})
                        .then((r) => {
                            self.parent = r.data;
                            self.form.parent_name = self.parent.name
                            self.isLoaded = true;
                        })
                } else {
                    self.isLoaded = true;
                }
            },
            save: function () {
                let self = this
                ChoiceService.store(self.form)
                    .then((r) => {
                        if (self.parent.id) {
                            self.$router.push({name: "choice-view", params: {id: self.parent.id}})
                        } else {
                            self.$router.push({name: "choice-home"})
                        }

                    })
                    .catch((e) => {
                        // TODO : handle errors
                    })
            }
        },
        created() {
            this.load();
        },
        mounted() {
        }
    }
</script>