<template>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                สระบุรีฟาร์ม
            </div>
            <form class="form-signin" v-on:submit.prevent="login">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input v-model="form.email" type="text" id="inputEmail" class="form-control" placeholder="Username"
                       required=""
                       autofocus="">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" v-model="form.password" id="inputPassword" class="form-control"
                       placeholder="Password" required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
            </form>
        </div>
    </div>
</template>
<style>
    html, body {
        background-color: #f5f5f5;
        color: inherit;
        /*font-family: 'Raleway', sans-serif;*/
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
<script>


    export default {
        data() {
            return {
                form: {
                    email: "",
                    password: "",
                }
            }
        },
        methods: {
            login: function () {
                let self = this
                axios.defaults.headers.common['Authorization'] = null;

                axios.post("/api/auth/login", {
                    email: self.form.email,
                    password: self.form.password,
                })
                    .then((response) => {
                        console.log(response)
                        localStorage.user = JSON.stringify(response.data)
                        localStorage.accessToken = response.data.accessToken

                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.accessToken;

                        self.$router.push("/home")

                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
        mounted() {
            console.log('Login Component mounted.')
        }

    }
</script>