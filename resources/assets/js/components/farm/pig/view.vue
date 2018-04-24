<template>
    <div class="card card-default mb-3" v-if="form">
        <div class="card-header">รายละเอียดสุกร</div>

        <div class="card-body">

            <div class="row">
                <div class="col-6">
                    <h6>PIGID</h6>
                    <p>{{form.pig_id}}</p>
                </div>

                <div class="col-6">
                    <h6 >เบอร์แม่พันธ์</h6>
                    <p>{{form.pig_number}}</p>
                </div>
                <div class="col-6">
                    <h6>วันเกิด</h6>
                    <p>{{form.birth_date}}</p>
                </div>
                <div class="col-6">
                    <h6>วันที่เข้าฟาร์ม</h6>
                    <p>{{form.entry_date}}</p>
                </div>
                <div class="col-6">
                    <h6>แหล่งที่มา</h6>
                    <p>{{form.source}}</p>
                </div>
                <div class="col-6">
                    <h6>พ่อพันธุ์</h6>
                    <p>{{form.male_breeder_pig_id}}</p>
                </div>
                <div class="col-6">
                    <h6>แม่พันธุ์</h6>
                    <p>{{form.female_breeder_pig_id}}</p>
                </div>
                <div class="col-6">
                    <h6>สายพันธุ์</h6>
                    <p>
                        <template v-if="typeof(form.blood_line) === 'object'">
                            {{form.blood_line.display_name}}
                        </template>
                    </p>
                </div>
                <div class="col-6">
                    <h6>เต้านม</h6>
                    <p>{{form.left_breast}}/{{form.right_breast}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ChoiceSelect from "../../admin/choice/choiceSelect";
    import PigService from "./service";

    export default {
        components: {ChoiceSelect},
        data() {
            return {
                form: null,
            }
        },
        methods: {

            load : function () {
                PigService.getById(this.$route.params.id)
                    .then((r)=>{
                        this.form = r.data;
                    })
            }
        },
        mounted() {
            this.load();

        }
    }
</script>