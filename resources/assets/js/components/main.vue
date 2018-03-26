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
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </main>
    </div>


</template>

<script>

    import VueRouter from 'vue-router'

    Vue.component(
        'example',
        require('./ExampleComponent.vue')
    )

    let router = new VueRouter({
        routes: [
            {path: '/', component: require('./example-charts/chart1')},
        ]
    });

    import navbars from './menus/navbars.vue'
    import menus from './menus/menus.vue'


    export default {
        router,
        components: {
            navbars, menus
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>