<template>
    <div class="card card-default mb-3">
        <div class="card-header">
            รายการสิทธิ์
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-end">

                <div class="justify-content-end">
                    <div class="input-group mb-3">
                        <form class="form form-inline" v-on:submit.default="load">
                            <input v-model="form.keyword" type="text" class="form-control"
                                   placeholder="ค้นหา">
                            <div class="input-group-append">
                                <button v-on:click="load" type="button" class="btn btn-info ">ค้นหา</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th>ชื่อ</th>
                    <th>การกระทำ</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in roles">
                    <td>{{item.name}}</td>
                    <td> -</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    import RoleService from "../../../services/RoleService"

    export default {
        data() {
            return {
                roles: [],
                paginate: null,
                form: {
                    keyword: null,
                }
            }
        },
        methods: {
            load: function () {
                let self = this
                RoleService.getPaginate(self.form)
                    .then(function (r) {
                        self.roles = r.data.data
                        self.paginate = r.data
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