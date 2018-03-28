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
                <div class="col">
                    <div class="float-right">
                        <form class="form-inline">
                            <label class="sr-only">ค้นหา</label>
                            <input type="text" class="form-control mb-2 mr-sm-2"
                                   placeholder="ค้นหา">
                            <button type="button" class="btn btn-primary mb-2">ค้นหา</button>
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
                <tr v-for="item in users">
                    <td>{{item.username}}</td>
                    <td> -</td>
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
                users: []
            }
        },
        methods: {
            load: function () {
                let self = this
                UserService.getAll()
                    .then(function (r) {
                        self.users = r.data
                    })
            }
        },
        mounted() {
            console.log('Role Home Component mounted.')
            this.load()
        }
    }
</script>