import Vue from 'vue'
import Notify from 'notifyjs-browser'

export const AlertBus = new Vue()

export default {
    createNotify: function (text, variant) {
        $.notify(text, {
            className: variant,
            position: "top center",
            autoHideDelay: 3000,
        });
    },
    createAlert: function (text, variant) {
        AlertBus.$emit("create-alert", text, variant)
    },

}