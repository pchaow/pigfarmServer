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
                        <pulse-loader :loading="spinnerVisible"></pulse-loader>
                        <router-view v-bind:hidden="spinnerVisible"></router-view>
                    </div>
                </div>
            </div>
        </main>
    </div>


</template>

<script>

    import navbars from './menus/navbars.vue'
    import menus from './menus/menus.vue'
    import {eventHub} from '../eventhub'

    export default {
        components: {
            navbars, menus
        },
        data() {
            return {
                spinnerVisible: false,
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