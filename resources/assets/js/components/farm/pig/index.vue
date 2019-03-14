<template>
    <v-layout column justify-center v-if="pigs">
        <v-flex>
            <v-card>
                <v-card-title>
                    <div class="headline">รายการสุกรแม่พันธุ์</div>
                    <v-btn color="primary" fab small dark :to="{name:'pig-add'}">
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
                        :items="pigs"
                        hide-actions>

                    <template slot="items" slot-scope="props">

                        <td>{{props.item.pig_id}}</td>
                        <td>{{props.item.pig_number}}</td>
                        <td>{{props.item.birth_date}}</td>
                        <td>{{props.item.entry_date}}</td>
                        <td>{{props.item.source}}</td>

                        <td>

                            <v-btn icon class="mx-0" :to="{ name: 'pig-edit', params: { id: props.item.id }}">
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

    import PigService from "./service"

    export default {
        data() {
            return {
                headers: [
                    {text: 'PigID', value: 'pig_id'},
                    {text: 'เบอร์แม่พันธุ์', value: 'pig_number'},
                    {text: 'วันเกิด', value: 'birth_date'},
                    {text: 'วันเข้าฟาร์ม', value: 'entry_date'},
                    {text: 'แหล่งที่มา', value: 'source'},
                    {text: 'การกระทำ', value: 'name', sortable: false},
                ],
                pigs: [],
                page : 1,
                form: {
                    page: 1,
                },
                paginate: {}
            }
        },
        methods: {
            changePage: function (page) {
                console.log("page", page);
                this.form.page = page
                this.load()
            },
            search: function () {
                this.form.page = 1;
                this.load();
            },
            load: function () {
                PigService.getPaginate(this.form)
                    .then((r) => {
                        this.paginate = r.data;
                        this.pigs = r.data.data;
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