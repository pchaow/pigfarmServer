<template>
    <div class="card card-default mb-3">
        <div class="card-header">
            รายการผู้ใช้
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <router-link to="/admin/role/add" class="btn btn-primary">เพิ่มผู้ใช้</router-link>
                </div>
                <div class="col-lg">
                    <div class="float-lg-right float-sm-left">
                        <form class="form form-inline" v-on:submit.default="load">

                            <div class="input-group mb-3">
                                <input v-model="form.keyword" type="text" class="form-control"
                                       placeholder="ค้นหา">
                                <div class="input-group-append">
                                    <button v-on:click="load" type="button" class="btn btn-primary ">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th>ชื่อ-นามสกุล</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>อีเมล์</th>
                    <th>สิทธิ์</th>
                    <th>การกระทำ</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in users">
                    <td>{{item.name}}</td>
                    <td>{{item.username}}</td>
                    <td>{{item.email}}</td>
                    <th>
                        <template v-for="role in item.roles">
                            {{role.name}}
                        </template>
                    </th>
                    <td>
                        <div class="btn-group">
                            <button class="btn">แก้ไข</button>
                            <button class="btn btn-danger">ลบ</button>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>

    import UserService from "../../services/UserService"

    export default {
        data() {
            return {
                users: [],
                paginate: null,
                form: {
                    keyword: null,
                    with: ['roles']
                }
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
            }
        },
        mounted() {
            console.log('Role Home Component mounted.')
            this.load()
        }
    }
</script>