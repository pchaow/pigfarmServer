<template>
    <v-app id="inspire">
        <loading :active.sync="spinnerVisible"></loading>

        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-flex xs-12 pb-3>
                            <v-alert type="error" :value="error.message">
                                {{error.message}}
                            </v-alert>
                        </v-flex>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                            <v-card-text>
                                <v-form v-on:submit.default="login()">
                                    <v-text-field
                                            :error-messages="error.errors.email"
                                            v-model="form.email" prepend-icon="person" name="login" label="Login"
                                            type="text"></v-text-field>
                                    <v-text-field v-model="form.password" prepend-icon="lock" name="password"
                                                  label="Password" id="password" type="password"></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn @click="login()" color="primary">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</template>


<script>

    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.min.css';


    export default {
        components: {
            Loading,
        },
        data() {
            return {
                form: {
                    email: "",
                    password: "",
                },
                error: {
                    errors : {},
                    message : null,
                },
                spinnerVisible: false,
                source: "null",

            }
        },
        methods: {
            showSpinner() {
                console.log('show spinner');
                this.spinnerVisible = true;
            },
            hideSpinner() {
                console.log('hide spinner');
                this.spinnerVisible = false;
            },
            login: function () {
                let self = this
                this.showSpinner();
                axios.defaults.headers.common['Authorization'] = null;

                axios.post("/api/auth/login", {
                    email: self.form.email,
                    password: self.form.password,
                })
                    .then((response) => {
                        console.log(response.data)
                        localStorage.user = JSON.stringify(response.data)
                        localStorage.accessToken = response.data.accessToken

                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.accessToken;

                        self.$router.push("/home")
                        self.hideSpinner();

                    })
                    .catch((error) => {
                        console.log(error.response.data)
                        self.hideSpinner();
                        this.error = error.response.data
                    })
            }
        },
        mounted() {
            console.log('Login Component mounted.')
        }

    }
</script>