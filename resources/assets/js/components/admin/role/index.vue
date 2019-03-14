<template>
    <v-layout column justify-center v-if="roles">
        <v-flex>
            <v-card>
                <v-card-title>
                    <div class="headline">รายการสิทธิ์</div>

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
                        :items="roles"
                        hide-actions
                >

                    <template slot="items" slot-scope="props">
                        <td>{{ props.item.name }}</td>
                        <td class="layout px-0">
                            <v-btn icon class="mx-0" disabled>
                                <v-icon color="teal">edit</v-icon>
                            </v-btn>
                            <v-btn icon class="mx-0" disabled>
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
</template>

<script>

    import RoleService from "../../../services/RoleService"

    export default {
        data() {
            return {
                roles: null,
                paginate: null,
                headers: [
                    {text: 'ชื่อ', value: 'name'},
                    {text: 'Actions', value: 'name', sortable: false},
                ],
                form: {
                    keyword: null,
                    page: 1,
                },
                page: 1,
            }
        },
        watch: {
            page: function (cur, old) {
                this.changePage(cur);
            }
        },
        methods: {
            changePage: function (page) {
                console.log("page", page);
                this.form.page = page
                this.load()
            },
            load: function () {
                let self = this
                RoleService.getPaginate(self.form)
                    .then(function (r) {
                        self.roles = r.data.data
                        self.paginate = r.data
                        console.log(self.paginate)
                    })
            }
        },
        created() {
            this.load()
        },
        mounted() {
            console.log('Role Home Component mounted.')

        }
    }
</script>