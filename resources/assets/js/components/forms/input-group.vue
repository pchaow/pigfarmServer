<template>
    <div class="form-group">
        <label>{{displayName}}</label>
        <input v-bind:value="value"
               v-on:input="$emit('input', $event.target.value)"

               :type="type" class="form-control"
               :class="{'is-invalid' : error.hasOwnProperty(errorkey) }"
               :placeholder="placeholder"
               v-bind:readonly="readonly"

        >
        <div class="invalid-feedback">
            {{error[errorkey]}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "input-group",
        props: {
            error: {
                type: [Object],
                default: () => {
                }
            },
            value: {
                type: [String, Number],
                default: () => {
                },
            },
            type: {
                type: String,
                default: "text",
            },
            errorkey: {
                type: String,
            },
            displayName: {
                type: String,
            },
            placeholder: {
                type: String,
                default: ""
            },
            readonly: {
                type: Boolean,
                default: false,
            }
        },

    }
</script>

<style scoped>

</style>