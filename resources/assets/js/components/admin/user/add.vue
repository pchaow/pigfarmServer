<template>
    <div class="card card-default mb-3">
        <div class="card-header">ผู้ใช้ใหม่</div>

        <div class="card-body">
            <form v-on:submit.default="save">
                <fieldset>
                    <legend>ข้อมูลพื้นฐาน</legend>
                    <div class="form-group">
                        <label>ชื่อ-นามสกุล</label>
                        <input v-model="form.name" type="text" class="form-control" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label>ชื่อผู้ใช้</label>
                        <input v-model="form.username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>อีเมล์</label>
                        <input v-model="form.email" type="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <input v-model="form.password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>ยืนยันรหัสผ่าน </label>
                        <input v-model="form.password_confirmation" type="password" class="form-control"
                               placeholder="Password Confirmation">
                    </div>

                </fieldset>

                <fieldset>
                    <legend>สิทธิ์การใช้งาน</legend>

                    <div class="form-group">
                        <label class="control-label">Roles : </label>
                        <div class="checkbox" v-for="role in roles">
                            <label>
                                <input v-model="form.roles" type="checkbox" v-bind:value="role">
                                {{role.name}}
                            </label>
                        </div>
                    </div>

                </fieldset>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
</template>

<script>
    import RoleService from "../../../services/RoleService";
    import UserService from "../../../services/UserService";

    export default {
        data() {
            return {
                roles: [],
                form: {
                    roles: []
                },
            }

        },
        methods: {
            load: function () {
                let self = this
                RoleService.getRoles()
                    .then((r) => {
                        self.roles = r.data
                    })
                    .catch((e) => {

                    })
            },
            save: function () {
                let self = this
                UserService.store(this.form)
                    .then((r) => {
                        self.$router.push("/admin/user")
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
            console.log('Example Component mounted.')
        }
    }
</script>