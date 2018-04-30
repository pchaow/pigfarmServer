<template>
    <div v-if="form">
        <pig-data :form="form"></pig-data>

        <div class="card card-default mb-3" v-if="form">
            <div class="card-header">ประวัติการให้ยาและการรักษา</div>
            <div class="card-body">

            </div>
        </div>
        <hr/>
        <router-link :to="{name : 'pig-breeder',params : {id:form.id}}" type="button" class="btn btn-primary mb-3">
            การผสมพันธุ์ใหม่
        </router-link>

        <template v-if="form" v-for="breeder in form.pig_breeds">

            <div class="card card-default mb-3" v-if="form">
                <div class="card-header">
                    การผสมครั้งที่ {{breeder.breed_sequence}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                            <h5>ข้อมูลการผสม</h5>
                            <div class="row">
                                <div class="col-2">
                                    <h6>ชุดผสม</h6>
                                    <p>{{breeder.breed_week}}</p>
                                </div>
                                <div class="col-2">
                                    <h6>วันที่ผสม</h6>
                                    <p>{{breeder.breed_date}}</p>
                                </div>
                                <div class="col-2">
                                    <h6>กำหนดคลอด</h6>
                                    <p>{{breeder.delivery_date}}</p>
                                </div>
                                <div class="col-2">
                                    <h6>พ่อพันธุ์ 1</h6>
                                    <p>{{breeder.breeder_1_id}}</p>
                                </div>
                                <div class="col-2">
                                    <h6>พ่อพันธุ์ 2</h6>
                                    <p>{{breeder.breeder_2_id}}</p>
                                </div>
                                <div class="col-2">
                                    <h6>พ่อพันธุ์ 3</h6>
                                    <p>{{breeder.breeder_3_id}}</p>
                                </div>

                                <div class="col-2">
                                    <h6>สถานะ</h6>
                                    <p>{{breeder.breed_status != null ? breeder.breed_status.display_name : ""}}</p>
                                </div>

                            </div>
                            <h5>ข้อมูลการคลอด</h5>
                            <h5>ข้อมูลการหย่านม</h5>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-block btn-info">บันทึกข้อมูล<br/>การคลอด</button>
                            <button type="button" class="btn btn-block btn-success">บันทึกข้อมูล การหย่านม</button>
                            <button type="button" class="btn btn-block btn-danger">ยกเลิกการผสม</button>
                        </div>
                    </div>

                </div>
            </div>
        </template>
    </div>
</template>

<script>
    import ChoiceSelect from "../../admin/choice/choiceSelect";
    import PigService from "./service";
    import PigData from "./pigData";

    export default {
        components: {PigData, ChoiceSelect},
        data() {
            return {
                form: null,
            }
        },
        methods: {

            load: function () {
                PigService.getById(this.$route.params.id, {
                    with: ["pigBreeds","pigBreeds.breedStatus"]
                })
                    .then((r) => {
                        this.form = r.data;
                    })
            }
        },
        mounted() {
            this.load();

        }
    }
</script>