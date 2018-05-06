<template>
    <div>

        <v-layout column justify-center v-if="choices">
            <v-flex>
                <v-card>
                    <v-card-title>
                        <div class="headline">รายการตัวเลือก</div>
                        <v-btn color="primary" fab small dark :to="{name:'choice-add'}">
                            <v-icon>mdi-plus</v-icon>
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-form v-on:submit.default="load()">
                            <v-text-field
                                    append-icon="search"
                                    label="ค้นหา"
                                    single-line
                                    hide-details
                                    v-model="form.keyword"
                            ></v-text-field>
                        </v-form>
                    </v-card-title>

                    <v-data-table
                            :headers="headers"
                            :items="choices"
                            hide-actions>

                        <template slot="items" slot-scope="props">

                            <td>{{props.item.name}}</td>
                            <td>{{props.item.display_name}}</td>
                            <td>{{props.item.description}}</td>

                            <td>

                                <v-btn icon class="mx-0" :to="{ name: 'choice-edit', params: { id: props.item.id }}">
                                    <v-icon color="teal">edit</v-icon>
                                </v-btn>
                                <v-btn icon class="mx-0" v-on:click="destroy(props.item)">
                                    <v-icon color="pink">delete</v-icon>
                                </v-btn>
                            </td>
                        </template>

                        <template slot="no-data">
                            <v-alert :value="true" color="error" icon="warning">
                                Sorry, nothing to display here :(
                            </v-alert>
                        </template>

                    </v-data-table>
                </v-card>

                <div class="text-xs-center pt-2">
                    <v-pagination :length="paginate.last_page" v-model="page"></v-pagination>
                </div>
            </v-flex>
        </v-layout>
    </div>

</template>

<script>

    import ChoiceService from "../../../services/ChoiceService"

    export default {
        data() {
            return {
                headers: [
                    {text: 'ชื่อตัวเลือก (Unique)', value: 'name'},
                    {text: 'ชื่อแสดง', value: 'display_name'},
                    {text: 'รายละเอียด', value: 'description'},
                    {text: 'การกระทำ', value: 'name', sortable: false},
                ],
                choices: [],
                paginate: null,
                form: {
                    keyword: null,
                    parent_id: null,
                }
            }
        },
        methods: {
            load: function () {
                let self = this
                ChoiceService.getPaginate(self.form)
                    .then(function (r) {
                        self.paginate = r.data
                        self.choices = r.data.data
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
        mounted() {
            this.load()
        }
    }
</script>