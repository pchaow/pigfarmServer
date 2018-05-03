<template>
    <v-app id="inspire">
        <loading :active.sync="spinnerVisible"></loading>

        <menus/>
        <v-toolbar color="indigo" dark fixed app
                   :clipped-left="$vuetify.breakpoint.lgAndUp"
                   fixed
        >
            <v-toolbar-side-icon @click.stop="toggleDrawer()"></v-toolbar-side-icon>
            <v-toolbar-title>สระบุรีฟาร์ม</v-toolbar-title>
        </v-toolbar>
        <v-content>
            <v-container fluid>
                <router-view/>
            </v-container>

        </v-content>
        <v-footer color="indigo" app>
            <span class="white--text">&copy; 2017</span>
        </v-footer>
    </v-app>
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
            drawer: true,
            spinnerVisible: false,

        }),
        methods: {
            showSpinner() {
                this.spinnerVisible = true;
            },
            hideSpinner() {
                this.spinnerVisible = false;
            },
            toggleDrawer() {
                eventHub.$emit('toggle-drawer')
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