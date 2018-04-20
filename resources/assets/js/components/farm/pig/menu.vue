<template>
    <div class="card mb-3">
        <div class="card-header">ฟาร์ม</div>
        <div class="card-body">
            <div class="list-group list-group-transparent mb-0">

                <router-link class="list-group-item list-group-item-action d-flex align-items-center"
                             :to="{ name : 'pig-home'}"
                             active-class="active">ค้นหาสุกร
                </router-link>

                <router-link class="list-group-item list-group-item-action d-flex align-items-center"
                             :to="{ name : 'pig-add'}" active-class="active">เพิ่มสุกร

                </router-link>

                <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">ค้นหาสุกร</a>

                <a class="list-group-item list-group-item-action d-flex align-items-center disabled" href="#">Disabled</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pigMenu"
    }
</script>

<style scoped>

</style>