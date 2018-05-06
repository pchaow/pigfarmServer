<template>
        <v-layout column justify-center v-if="roles">
            <v-flex>
                <v-card>
                    <v-card-title>
                        <div class="headline">เพิ่มผู้ใช้</div>
                    </v-card-title>
                    <v-card-text>
                        <h2 class="title">ข้อมูลทั่วไป</h2>
                        <v-text-field label="ชื่อ-นามสกุล" v-model="form.name"
                                      :error-messages="error.errors.name"/>
                        <v-text-field label="ชื่อผู้ใช้" v-model="form.username"
                                      :error-messages="error.errors.username"/>
                        <v-text-field label="อีเมล์" v-model="form.email"
                                      :error-messages="error.errors.email"/>
                        <v-text-field label="รหัสผ่าน" v-model="form.password" type="password"
                                      :error-messages="error.errors.password"/>
                        <v-text-field label="ยืนยันรหัสผ่าน" v-model="form.password_confirmation" type="password"/>
                        <h2 class="title">สิทธิ์การใช้งาน</h2>
                        <role-checkbox
                                v-bind:value="form.roles"
                                @change="updateRoles"
                        ></role-checkbox>
                        <v-divider/>

                    </v-card-text>
                    <v-card-actions>
                        <v-btn @click="save()" color="primary">Submit</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
</template>

<script>
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
                error: {
                    errors: {},
                    message: null,
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