<template>
    <v-navigation-drawer
            fixed
            :clipped="$vuetify.breakpoint.mdAndUp"
            app
            v-model="drawer">
        <v-list>
            <v-list-tile :to="{name:'home-index'}" exact>
                <v-list-tile-action>
                    <v-icon>home</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Home</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile :to="{name:'home-chart1'}" exact>
                <v-list-tile-action>
                    <v-icon>mdi-chart-bar</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Example Chart</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
        <v-divider/>
        <v-list>
            <v-list-tile :to="{name:'user-home'}" exact>
                <v-list-tile-action>
                    <v-icon>mdi-account</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>การจัดการผู้ใช้</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile :to="{name:'role-home'}" exact>
                <v-list-tile-action>
                    <v-icon>mdi-account-group</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>การจัดการสิทธิ์</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
        <pig-menu/>

    </v-navigation-drawer>

</template>

<script>

    import pigMenu from "../farm/pig/menu";
    import {eventHub} from '../../eventhub';


    export default {
        components: {
            pigMenu
        },
        data: () => ({
            drawer: true,
        }),
        methods: {
            toggleDrawer : function(){
                this.drawer = !this.drawer;
                console.log(this.drawer);
            }
        },
        mounted() {
            console.log('Component mounted.')
            eventHub.$on('toggle-drawer',this.toggleDrawer);
        },
        beforeDestroy: function () {
            eventHub.$off('toggle-drawer',this.toggleDrawer);
        },


    }
</script>