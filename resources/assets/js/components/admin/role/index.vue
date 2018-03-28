<template>
    <div class="card card-default mb-3">
        <div class="card-header">
            รายการสิทธิ์
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <router-link to="/admin/role/add" class="btn btn-primary">เพิ่มสิทธิ์</router-link>
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
                roles: []
            }
        },
        methods: {
            load: function () {
                let self = this
                RoleService.getAll()
                    .then(function (r) {
                        self.roles = r.data
                    })
            }
        },
        mounted() {
            console.log('Role Home Component mounted.')
            this.load()
        }
    }
</script>