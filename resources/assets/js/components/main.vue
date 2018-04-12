<template>
    <div>
        <navbars></navbars>
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <menus></menus>
                    </div>
                    <div class="col justify-content-center">
                        <loading :active.sync="spinnerVisible"></loading>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </main>
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
        data() {
            return {
                spinnerVisible: false,
            }
        },
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