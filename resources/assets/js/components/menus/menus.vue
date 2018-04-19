<template>
    <div>

        <div class="card mb-3">
            <div class="card-header">ผู้บริหาร</div>
            <div class="card-body">
                <div class="list-group list-group-transparent mb-0">

                    <router-link class="list-group-item list-group-item-action d-flex align-items-center" to="/home/"
                                 active-class="active" exact>Home
                    </router-link>

                    <router-link class="list-group-item list-group-item-action d-flex align-items-center"
                                 to="/home/chart1" active-class="active" exact="">Chart1

                    </router-link>

                    <a class="list-group-item list-group-item-action d-flex align-items-center" href="#">ค้นหาสุกร</a>

                    <a class="list-group-item list-group-item-action d-flex align-items-center disabled" href="#">Disabled</a>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">ผู้ดูแลระบบ</div>
            <div class="card-body">

                <div class="list-group list-group-transparent mb-0">

                    <router-link class="list-group-item list-group-item-action d-flex align-items-center" to="/admin/user" active-class="active">
                        การจัดการผู้ใช้
                    </router-link>

                    <router-link class="list-group-item list-group-item-action d-flex align-items-center" to="/admin/role" active-class="active">
                        การจัดการสิทธิ์
                    </router-link>

                    <router-link class="list-group-item list-group-item-action d-flex align-items-center" to="/admin/choice" active-class="active">
                        ข้อมูลพื้นฐานระบบ
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>