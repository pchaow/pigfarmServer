<template>
    <div class="card card-default mb-3">
        <div class="card-header">
            รายการข้อมูลพื้นฐานและตัวเลือก
        </div>

        <div class="card-body">
            <div class="d-flex">
                <div class="mr-auto">
                    <router-link
                            :to="{ name: 'choice-add'}"
                            class="btn btn-primary">
                        เพิ่มรายการ
                    </router-link>
                </div>
                <div class="">
                    <div class="float-lg-right float-sm-left">
                        <form class="form form-inline" v-on:submit.default="load">

                            <div class="input-group mb-3">
                                <input v-model="form.keyword" type="text" class="form-control"
                                       placeholder="ค้นหา">
                                <div class="input-group-append">
                                    <button v-on:click="load" type="button" class="btn btn-info ">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th>ชื่อตัวเลือก (Unique)</th>
                    <th>ขื่อแสดง</th>
                    <th>รายละเอียด</th>
                    <th>การกระทำ</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in choices">
                    <td>{{item.name}}</td>
                    <td>{{item.display_name}}</td>
                    <td>{{item.description}}</td>
                    <td>
                        <div class="btn-group">
                            <router-link :to="{ name: 'choice-view', params: { id: item.id }}" class="btn btn-info">
                                รายละเอียด
                            </router-link>
                            <router-link :to="{ name: 'choice-edit', params: { id: item.id }}" class="btn btn-light">
                                แก้ไข
                            </router-link>
                            <button v-on:click="destroy(item)" class="btn btn-danger">ลบ</button>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</template>

<script>

    import ChoiceService from "../../../services/ChoiceService"

    export default {
        data() {
            return {
                choices: [],
                paginate: null,
                form: {
                    keyword: null,
                    parent_id: null,
                }
            }
        },
        methods: {
            load: function () {
                let self = this
                ChoiceService.getPaginate(self.form)
                    .then(function (r) {
                        self.paginate = r.data
                        self.choices = r.data.data
                    })
            },
            destroy: function (item) {
                ChoiceService.destroy(item.id)
                    .then((r) => {
                        this.load();
                    })
                    .catch((e) => {
                        // TODO : Show error message
                    })

            }
        },
        mounted() {
            this.load()
        }
    }
</script>