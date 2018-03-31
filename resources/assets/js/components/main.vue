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
                        <pulse-loader></pulse-loader>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </main>
    </div>


</template>

<script>

    import navbars from './menus/navbars.vue'
    import menus from './menus/menus.vue'


    export default {
        components: {
            navbars, menus
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>