<template>
    <div class="card card-default mb-3">
        <div class="card-header">
            รายการสุกร
        </div>

        <div class="card-body">
            <div class="d-flex">
                <div class="justify-content-end ml-auto">
                    <form class="form form-inline" v-on:submit.default="">
                        <div class="input-group mb-3">

                            <input v-model="form.keyword" type="text" class="form-control"
                                   placeholder="ค้นหา">
                            <div class="input-group-append">
                                <button v-on:click="" type="button" class="btn btn-info ">ค้นหา</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped text-nowrap">
                    <thead class="thead-light">
                    <tr>
                        <th>PigID</th>
                        <th>เบอร์แม่พันธุ์</th>
                        <th>วันเกิด</th>
                        <th>วันเข้าฟาร์ม</th>
                        <th>แหล่งที่มา</th>
                        <th>พ่อพันธ์ุ</th>
                        <th>แม่พันธุ์</th>
                        <th>สายพันธุ์</th>
                        <th>เต้านม</th>
                        <th>สถานะ</th>
                        <th>การกระทำ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in pigs">
                        <td>{{item.pig_id}}</td>
                        <td>{{item.pig_number}}</td>
                        <td>{{item.birth_date}}</td>
                        <td>{{item.entry_date}}</td>
                        <td>{{item.source}}</td>
                        <td>{{item.male_breeder_pig_id}}</td>
                        <td>{{item.female_breeder_pig_id}}</td>
                        <td>{{item.blood_line.display_name}} </td>
                        <td>{{item.left_breast}} / {{item.right_breast}}</td>
                        <td>{{item.status}}</td>
                        <td>
                            Action
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    import PigService from "./service"

    export default {
        data() {
            return {
                pigs: [],
                form: {},
                paginate: {}
            }
        },
        methods: {
            load: function () {
                PigService.getPaginate(this.form)
                    .then((r) => {
                        this.paginate = r.data;
                        this.pigs = r.data.data;
                    })
            }
        },
        created() {

        },
        mounted() {
            this.load();

        }
    }
</script>