<template>
    <div>

        <div v-for="alert in alerts" class="alert alert-warning alert-dismissible fade show" role="alert">
            {{alert.msg}}
            <button type="button" class="close" data-dismiss="alert"  v-on:click="dismiss(alert)" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

</template>

<script>
    export default {
        name: "alert",
        data() {
            return {
                alerts: [
                    {'msg': "hello world"}
                ],
            }
        },
        methods: {
            dismiss(alert) {
                setTimeout(()=>{
                    this.alerts.splice(this.alerts.indexOf(alert, 1))
                },3000)

            }
        },
        created() {

        },
        beforeDestroy() {

        }
    }
</script>

<style scoped>

</style>