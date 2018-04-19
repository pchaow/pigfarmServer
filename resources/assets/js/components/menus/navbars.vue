<template>
    <div class="header py-4">
        <div class="container">
            <div class="d-flex">
                <router-link :to="{ name : 'home-index'}" class="header-brand" href="./index.html">
                    สระบุรีฟาร์ม
                </router-link>
                <div class="d-flex order-lg-2 ml-auto">


                    <div class="dropdown" v-if="currentUser">
                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                            <span class="avatar" style="background-image: url(/images/demo.png)"></span>
                            <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{currentUser.username}}</span>
                      <small class="text-muted d-block mt-1" v-if="currentUser.roles.length > 0">{{currentUser.roles[0].display_name}}</small>
                    </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="float-right"><span class="badge badge-primary">6</span></span>
                                <i class="dropdown-icon fe fe-mail"></i> Inbox
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-send"></i> Message
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                            </a>
                            <a class="dropdown-item" href="#" @click="logout">
                                <i class="dropdown-icon fe fe-log-out"></i> Sign out
                            </a>
                        </div>
                    </div>
                </div>
                <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                    <span class="header-toggler-icon"></span>
                </a>
            </div>
        </div>
    </div>
</template>
<script>

    import UserService from '../../services/UserService'

    export default {
        data() {
            return {
                currentUser: null
            }
        },
        methods: {
            logout: function () {
                let self = this
                localStorage.removeItem("accessToken");
                localStorage.removeItem("user");
                self.$router.push('/login')
            },
            load: function () {
                let self = this
                if (localStorage.getItem("user") == null) {
                    UserService.getCurrentUser()
                        .then((r) => {
                            self.currentUser = r.data
                        })
                } else {
                    self.currentUser = JSON.parse(localStorage.getItem("user"))
                }

                console.log(self.currentUser)

            }
        },
        mounted() {
            console.log('Navbar mounted.')
            this.load()
        }
    }
</script>