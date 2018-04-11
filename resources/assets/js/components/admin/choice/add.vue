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

                    <role-checkbox
                            v-bind:value="form.roles"
                            @change="updateRoles"
                    ></role-checkbox>

                </fieldset>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
</template>

<script>
    import RoleService from "../../../services/RoleService";
    import UserService from "../../../services/UserService";

    import RoleCheckbox from "../role/checkbox";

    export default {
        components: {
            RoleCheckbox
        },
        data() {
            return {
                roles: [],
                form: {
                    roles: []
                },
            }

        },
        methods: {
            updateRoles: function ($event) {
                let roles = this.form.roles
                let i = roles.indexOf($event)
                if( i == -1 ){
                    roles.push($event)
                }else {
                    roles.splice(i,1);
                }
            },
            load: function () {
                let self = this
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