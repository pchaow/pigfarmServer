<template>
    <div v-if="form">
        <pig-data :form="form"></pig-data>

        <div class="card card-default mb-3" v-if="form">
            <div class="card-header">ประวัติการให้ยาและการรักษา</div>
            <div class="card-body">

            </div>
        </div>
        <hr/>
        <router-link :to="{name : 'pig-breeder',params : {id:form.id}}" type="button" class="btn btn-primary mb-3">การผสมพันธุ์ใหม่</router-link>

        <div class="card card-default mb-3" v-if="form">
            <div class="card-header">
                การผสมครั้งที่ 1
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <p>ข้อมูลการผสม</p>
                        <p>ข้อมูลการคลอด</p>
                        <p>ข้อมูลการหย่านม</p>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-block btn-info">บันทึกข้อมูลการคลอด</button>
                        <button type="button" class="btn btn-block btn-success">บันทึกข้อมูลการหย่านม</button>
                        <button type="button" class="btn btn-block btn-danger">ยกเลิกการผสม</button>
                    </div>
                </div>

            </div>
        </div>
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
                PigService.getById(this.$route.params.id)
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