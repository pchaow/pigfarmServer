<template>
    <div>
        <div class="checkbox" v-for="role in roles">
            <v-checkbox :label="role.name"
                        v-bind:value="role"
                        v-on:change="$emit('change', role)"
                        :input-value="value"
            >
            </v-checkbox>
        </div>
    </div>
</template>

<script>
    import RoleService from "../../../services/RoleService";

    export default {
        name: "role-checkbox",
        props: {
            value: {
                type: [Array],
                default: () => []
            }
        },
        data() {
            return {
                roles: [],
                selected: [],
            }
        },
        methods: {
            sync: function () {
                let roles_length = this.roles.length;
                let sel_length = this.value.length;

                let roles = this.roles;
                let sel = this.value;

                for (let i = 0; i < roles_length; i++) {
                    for (let j = 0; j < sel_length; j++) {
                        if (roles[i].id == sel[j].id) {
                            roles[i] = sel[j]
                        }
                    }
                }
            },
            load: function () {
                RoleService.getRoles()
                    .then((r) => {
                        this.roles = r.data
                        this.sync();
                        console.log(this.roles);
                        console.log(this.value);
                    })
            }
        },
        created: function () {
            this.load();
        },
        mounted: function () {
            console.log('role-checkbox mounted')
        }

    }
</script>

<style scoped>

</style>