<template>
    <v-layout column justify-center v-if="users">
        <v-flex>
            <v-card>
                <v-card-title>
                    <h1>รายการผู้ใช้</h1>
                    <v-btn color="primary" fab small dark :to="{name:'user-add'}">
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
                        :items="users"
                        hide-actions
                >

                    <template slot="items" slot-scope="props">

                        <td>{{props.item.name}}</td>
                        <td>{{props.item.username}}</td>
                        <td>{{props.item.email}}</td>
                        <td>
                            <template v-for="role in props.item.roles">
                                {{role.name}}
                            </template>
                        </td>
                        <td>

                            <v-btn icon class="mx-0" :to="{ name: 'user-edit', params: { id: props.item.id }}">
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

</template>

<script>

    import UserService from "../../../services/UserService"

    export default {
        data() {
            return {
                headers: [
                    {text: 'ชื่อ-นามสกุล', value: 'name'},
                    {text: 'ชื่อผู้ใช้', value: 'username'},
                    {text: 'อีเมล์', value: 'email'},
                    {text: 'สิทธิ์', value: 'roles'},
                    {text: 'การกระทำ', value: 'name', sortable: false},
                ],
                users: null,
                paginate: null,
                form: {
                    keyword: null,
                    with: ['roles']
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
            load: function () {
                let self = this
                UserService.getPaginate(self.form)
                    .then(function (r) {
                        self.paginate = r.data
                        self.users = r.data.data
                    })
            },
            destroy: function (item) {
                UserService.destroy(item.id)
                    .then((r) => {
                        this.load();
                    })
                    .catch((e) => {
                        // TODO : Show error message
                    })

            }
        },
        mounted() {
            console.log('Role Home Component mounted.')
            this.load()
        }
    }
</script>