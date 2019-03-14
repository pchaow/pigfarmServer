<template>
    <div v-if="options">
        <v-select
                :items="options"
                v-model="select"
                label="Select"
                single-line
                @change="$emit('change',select)"
                item-text="display_name">
        </v-select>
    </div>
</template>

<script>

    import ChoiceService from "../../../services/ChoiceService"

    export default {
        name: "choice-select",
        props: {
            label: {
                type: String,
                default: "ตัวเลือก"
            },
            type: {
                type: [Object],
                default: () => []
            },
            value: {
                type: [Object],
                default: () => null,
            }
        },
        data() {
            return {
                choice: null,
                options: null,
                select: null,
            }
        },
        methods: {
            sync: function () {
                let self = this;
                for (let i = 0; i < self.options.length; i++) {
                    if (self.options[i].id === self.value.id) {
                        self.select = self.options[i];
                        self.$emit('change', self.select);
                    }
                }
            },
            load: function () {
                let self = this;
                ChoiceService.getByName(self.type.to)
                    .then((r) => {
                        self.choice = r.data;
                        self.options = r.data.children;

                        if (self.value) {
                            self.sync();
                        }
                    })

            }
        },
        created() {
        },
        mounted() {
            this.load();
        },
    }
</script>

<style scoped>

</style>