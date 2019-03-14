<template>

    <v-text-field :label="displayName"
                  v-bind:value="value"
                  v-on:input="$emit('input', value)"
                  :type="type" :error-messages="error[errorkey]"/>

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