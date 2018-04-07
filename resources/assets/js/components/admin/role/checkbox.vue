<template>
    <div>
        <div class="form-group">
            <label class="control-label">Roles : </label>
            <div class="checkbox" v-for="role in roles">
                <label>
                    <input type="checkbox" v-bind:value="role"
                           v-on:change="$emit('change', [1,2,3])">
                    {{role.name}}
                </label>
            </div>
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
                default: []
            }
        },
        data() {
            return {
                roles: []
            }
        },
        methods: {
            load: function () {
                RoleService.getRoles()
                    .then((r) => {
                        this.roles = r.data
                    })
            }
        },
        created: function () {
            this.load()
        },
        mounted: function () {
            console.log('role-checkbox mounted')
        }

    }
</script>

<style scoped>

</style>