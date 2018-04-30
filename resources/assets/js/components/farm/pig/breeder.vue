<template>
    <div v-if="pigData">
        <pig-data :form="pigData"></pig-data>

        <div class="card card-default mb-3" v-if="pigData">
            <div class="card-header">รายงานการผสม</div>

            <div class="card-body">

                <form v-on:submit.default="save">
                    <fieldset>
                        <legend>รายงานการผสม</legend>
                        <div class="row">

                            <input-group class="col-lg-4 col-sm-12"
                                         v-model="form.breed_date"
                                         :error="error" display-name="วันที่ผสม"
                                         type="date"
                                         errorkey="breed_date"
                                         placeholder=""
                                         v-on:input="updateBreedWeek()"/>


                            <input-group class="col-lg-4 col-sm-12"
                                         v-model="form.breed_week"
                                         :error="error"
                                         display-name="ชุดผสม"
                                         type="number" errorkey="breed_week" placeholder=""
                                         :readonly="true"/>

                            <input-group class="col-lg-4 col-sm-12" v-model="form.delivery_date"
                                         :error="error"
                                         display-name="กำหนดคลอด"
                                         type="date" errorkey="breed_week" placeholder=""
                                         :readonly="true"/>

                            <input-group class="col-lg-4 col-sm-12"
                                         v-model="form.breeder_1_id"
                                         :error="error"
                                         display-name="พ่อพันธุ์ 1"
                                         type="text" errorkey="breeder_1_id" placeholder=""/>
                            <input-group class="col-lg-4 col-sm-12"
                                         v-model="form.breeder_2_id"
                                         :error="error"
                                         display-name="พ่อพันธุ์ 2"
                                         type="text" errorkey="breeder_2_id" placeholder=""/>
                            <input-group class="col-lg-4 col-sm-12"
                                         v-model="form.breeder_3_id"
                                         :error="error"
                                         display-name="พ่อพันธุ์ 3"
                                         type="text" errorkey="breeder_3_id" placeholder=""/>


                        </div>


                    </fieldset>
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <router-link :to="{name : 'pig-view',params : {id:pigData.id}}" class="btn btn-light">ยกเลิก
                    </router-link>

                </form>
            </div>
        </div>

    </div>
</template>

<script>
    import ChoiceSelect from "../../admin/choice/choiceSelect";
    import PigService from "./service";
    import PigData from "./pigData";
    import InputGroup from "../../forms/input-group";

    export default {
        components: {InputGroup, PigData, ChoiceSelect},
        data() {
            return {
                pigData: null,
                form: {},
                error: {},
            }
        },
        methods: {
            save: function () {
                console.log(this.form);
            },
            load: function () {
                PigService.getById(this.$route.params.id)
                    .then((r) => {
                        this.pigData = r.data;
                    })
            },
            updateBreedWeek: function () {
                let moment = this.$moment;
                let date = this.form.breed_date;
                date = moment(date)
                console.log(date.week());
                this.form.breed_week = date.week();
                this.form.delivery_date = date.add(114,'days').format('YYYY-MM-DD')
            },

        },
        mounted() {
            this.load();

        }
    }
</script>