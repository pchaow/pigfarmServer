<template>
    <div>
        <div class="card mb-3">
            <div class="card-header">ผู้บริหาร</div>
            <div class="card-body">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/home/" exact-active-class="active">Home</router-link>

                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" to="/home/chart1" exact-active-class="active">Chart1</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ค้นหาสุกร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="card">
            <div class="card-header">ผู้ดูแลระบบ</div>
            <div class="card-body">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">การจัดการผู้ใช้</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">การจัดการสิทธิ์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ข้อมูลพื้นฐานระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ข้อมูลพื้นฐานฟาร์ม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
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