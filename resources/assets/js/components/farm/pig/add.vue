<template>
    <div class="card card-default mb-3">
        <div class="card-header">เพิ่มสุกร</div>

        <div class="card-body">
            <form v-on:submit.default="save">
                <fieldset>
                    <legend>ข้อมูลพื้นฐาน</legend>
                    <div class="form-group">
                        <label>PIGID</label>
                        <input class="form-control" type="text" v-model="form.pig_id" placeholder="##-####"/>
                    </div>

                    <div class="form-group">
                        <label>เบอร์แม่พันธุ์</label>
                        <input class="form-control" type="text" v-model="form.pig_number" placeholder="####"/>
                    </div>

                    <div class="form-group">
                        <label>วันเกิด</label>
                        <input class="form-control" type="date" v-model="form.birth_date"/>
                    </div>

                    <div class="form-group">
                        <label>วันที่เข้าฟาร์ม</label>
                        <input class="form-control" type="date" v-model="form.entry_date"/>
                    </div>

                    <div class="form-group">
                        <label>แหล่งที่มา</label>
                        <input class="form-control" type="text" v-model="form.source" placeholder="แหล่งที่มา"/>
                    </div>

                    <div class="form-group">
                        <label>พ่อพันธุ์</label>
                        <input class="form-control" type="text" v-model="form.male_breeder_pig_id"
                               placeholder="พ่อพันธุ์"/>
                    </div>
                    <div class="form-group">
                        <label>แม่พันธุ์</label>
                        <input class="form-control" type="text" v-model="form.female_breeder_pig_id"
                               placeholder="แม่พันธุ์"/>
                    </div>

                    <div class="form-group">
                        <label>สายพันธุ์</label>
                        <choice-select :type="{to:'BREED'}" :value="form.blood_line"
                                       @change="form.blood_line = $event"></choice-select>
                    </div>

                    <div class="form-group">
                        <label>เต้านม (ซ้าย)</label>
                        <input class="form-control" type="number" v-model="form.left_breast"/>
                    </div>

                    <div class="form-group">
                        <label>เต้านม (ขวา)</label>
                        <input class="form-control" type="number" v-model="form.right_breast"/>
                    </div>

                    <div class="form-group">
                        <label>สถานะ (อยู่ระหว่างการพัฒนาตัวเลือก)</label>
                        <input class="form-control" type="text" v-model="form.status"
                               placeholder="สถานะ"/>
                    </div>

                </fieldset>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
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
                form: {
                    blood_line: {},
                },
            }
        },
        methods: {
            save: function () {
                console.log(this.form)
                PigService.store(this.form)
                    .then((r) => {
                        this.$router.push({name : 'pig-index'})
                    })
            }
        },
        mounted() {
            console.log('Example Component mounted.')
        }
    }
</script>