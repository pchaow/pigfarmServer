<template>
    <v-layout column justify-center v-if="form">
        <v-flex>
            <v-card>
                <v-card-title>
                    <div class="headline">แก้ไขสุกร</div>
                </v-card-title>
                <v-card-text>
                    <h2 class="title">ข้อมูลทั่วไป</h2>
                    <v-text-field label="PIGID" v-model="form.pig_id"
                                  :error-messages="error.errors.pig_id"/>
                    <v-text-field label="เบอร์แม่พันธุ์" v-model="form.pig_number"
                                  :error-messages="error.errors.pig_number"/>

                    <v-text-field label="วันเกิด" v-model="form.birth_date"
                                  :error-messages="error.errors.birth_date"/>

                    <v-text-field label="วันเข้าฟาร์ม" v-model="form.entry_date"
                                  :error-messages="error.errors.entry_date"/>

                    <v-text-field label="หมายเลขพ่อพันธุ์" v-model="form.male_breeder_pig_id"
                                  :error-messages="error.errors.male_breeder_pig_id"/>
                    <v-text-field label="หมายเลขแม่พันธุ์" v-model="form.female_breeder_pig_id"
                                  :error-messages="error.errors.female_breeder_pig_id"/>

                    <choice-select :type="{to:'BREED'}" :value="form.blood_line"
                                   @change="form.blood_line = $event"></choice-select>

                    <v-text-field label="เต้านม (ซ้าย)" v-model="form.left_breast"
                                  :error-messages="error.errors.left_breast"/>
                    <v-text-field label="เต้านม (ขวา)" v-model="form.right_breast"
                                  :error-messages="error.errors.right_breast"/>
                    <v-text-field label="สถานะ" v-model="form.status"
                                  :error-messages="error.errors.status"/>

                </v-card-text>
                <v-card-actions>
                    <v-btn @click="save()" color="primary">Submit</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import ChoiceSelect from "../../admin/choice/choiceSelect";
    import PigService from "./service";
    import InputGroup from "../../forms/input-group";

    export default {
        components: {InputGroup, ChoiceSelect},
        data() {
            return {
                form: {
                    blood_line: {},
                },
                error: {
                    errors: {},
                    message: null,
                },
            }
        },
        methods: {
            save: function () {
                // console.log(this.form)
                let req = PigService.store(this.form)
                req.then((r) => {
                    this.$router.push({name: 'pig-index'})
                });
                req.catch((err) => {
                    this.error = err.response.data
                    console.log(err.response.data);
                });
            }
        },
        mounted() {
            console.log('Example Component mounted.')
        }
    }
</script>