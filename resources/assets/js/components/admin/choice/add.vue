<template>
    <div class="card card-default mb-3" v-if="isLoaded">
        <div class="card-header">

            <span v-if="parent">เพิ่มข้อมูลย่อย -{{parent.name}} - {{parent.display_name}}</span>
            <span v-else>เพิ่มข้อมูลพื้นฐาน</span>
        </div>

        <div class="card-body">
            <form v-on:submit.default="save">
                <fieldset>
                    <legend>รายละเอียด</legend>
                    <input type="hidden" v-model="form.parent_id"/>
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

                    <template v-for="(value,key) in parent.children_fields">
                        <div class="form-group">
                            <label>{{value.display_name}}</label>

                            <input v-if="value.type == 'text'" v-model="form.children_values[key]" type="text"
                                   class="form-control"
                                   placeholder="Placeholder">
                            <input v-if="value.type == 'number'" v-model="form.children_values[key]" type="number"
                                   class="form-control"
                                   placeholder="Placeholder">

                            <choice-select @change="updateField($event,key)" :type="value"></choice-select>

                        </div>
                    </template>


                    <div class="form-group">
                        <label>Children Field</label>
                        <textarea rows="10" class="form-control" v-model="form.children_fields"></textarea>
                    </div>


                </fieldset>

                <button type="submit" class="btn btn-primary">Submit</button>

                <router-link v-if="form.parent_id"
                             :key="$route.fullPath"
                             :to="{ name: 'choice-edit', params: { id: form.parent_id }}"
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
                    parent_id: parent_id,
                    children: [],
                    children_values: {},
                },
            }

        },
        methods: {

            updateField: function ($event, key) {
                console.log($event, key);
                this.form.children_values[key] = $event;
            },
            load: function () {
                let self = this
                if (self.$route.params.id) {
                    ChoiceService.getById(self.$route.params.id, {})
                        .then((r) => {
                            self.parent = r.data;
                            self.parent.children_fields = JSON.parse(self.parent.children_fields)
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
                        if (self.form.parent_id) {
                            self.$router.push({name: "choice-edit", params: {id: self.form.parent_id}})
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