<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link class="navbar-brand" to="/home">
                สระบุรีฟาร์ม
            </router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li v-if="currentUser == null"><a class="nav-link" href="#">Login</a></li>
                    <li v-if="currentUser == null"><a class="nav-link" href="#">Register</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{currentUser? currentUser.username : ""}}<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" v-on:click="logout">
                                Logout
                            </a>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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