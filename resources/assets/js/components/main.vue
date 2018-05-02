<template>
    <div>
        <v-app id="inspire">
            <v-navigation-drawer fixed v-model="drawer" app>
                <v-list dense>
                    <v-list-tile :to="{name:'home-index'}" exact>
                        <v-list-tile-action>
                            <v-icon >home</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Home</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile :to="{name:'home-chart1'}" exact>
                        <v-list-tile-action>
                            <v-icon>contact_mail</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Contact</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-navigation-drawer>
            <v-toolbar color="indigo" dark fixed app>
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <v-toolbar-title>Application</v-toolbar-title>
            </v-toolbar>
            <v-content>
                <v-container fluid fill-height>
                    <v-layout justify-center align-center>
                        <router-view/>
                    </v-layout>
                </v-container>
            </v-content>
            <v-footer color="indigo" app>
                <span class="white--text">&copy; 2017</span>
            </v-footer>
        </v-app>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.min.css';

    import navbars from './menus/navbars.vue'
    import menus from './menus/menus.vue'
    import {eventHub} from '../eventhub'

    export default {
        components: {
            navbars, menus, Loading, alert

        },
        data: () => ({
            drawer: false,
        }),
        methods: {
            showSpinner() {
                this.spinnerVisible = true;
            },
            hideSpinner() {
                this.spinnerVisible = false;
            }
        },
        created() {
            eventHub.$on('before-request', this.showSpinner);
            eventHub.$on('request-error', this.hideSpinner);
            eventHub.$on('after-response', this.hideSpinner);
            eventHub.$on('response-error', this.hideSpinner);
        },
        beforeDestroy: function () {
            eventHub.$off('before-request', this.showSpinner);
            eventHub.$off('request-error', this.hideSpinner);
            eventHub.$off('after-response', this.hideSpinner);
            eventHub.$off('response-error', this.hideSpinner);
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>