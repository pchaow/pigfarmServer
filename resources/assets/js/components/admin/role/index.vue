<template>
    <div class="card card-default mb-3">
        <div class="card-header">
            รายการสิทธิ์
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg">
                    <router-link to="/admin/role/add" class="btn btn-primary">เพิ่มสิทธิ์</router-link>
                </div>
                <div class="col-lg">
                    <div class="float-lg-right float-sm-left">

                        <div class="input-group mb-3">
                            <input v-model="form.keyword" type="text" class="form-control"
                                   placeholder="ค้นหา">
                            <div class="input-group-append">
                                <button v-on:click="load" type="button" class="btn btn-primary ">ค้นหา</button>
                            </div>
                        </div>
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

    import RoleService from "../../services/RoleService"

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
        mounted() {
            console.log('Role Home Component mounted.')
            this.load()
        }
    }
</script>