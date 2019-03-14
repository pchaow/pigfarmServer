<template>
    <v-list>
        <v-list-group prepend-icon="account_circle" value="true">
            <v-list-tile slot="activator">
                <v-list-tile-title>การจัดการสุกร</v-list-tile-title>
            </v-list-tile>

            <v-list-tile :to="{name:'pig-home'}">
                <v-list-tile-action></v-list-tile-action>
                <v-list-tile-title>ค้นหาสุกร</v-list-tile-title>
            </v-list-tile>

            <v-list-tile :to="{name:'pig-add'}">
                <v-list-tile-action></v-list-tile-action>
                <v-list-tile-title>เพิ่มสุกร</v-list-tile-title>
            </v-list-tile>

        </v-list-group>
    </v-list>
</template>

<script>
    export default {
        name: "pigMenu"
    }
</script>

<style scoped>

</style>