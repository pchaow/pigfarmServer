export default {

    getRoles() {
        return axios.get("/api/roles?paginate=false")
    },
    getPaginate(form) {
        return axios.get("/api/roles", {
            params: form
        })
    },
    getById(id) {
        return axios.get("/api/roles/" + id)
    },
    store(form) {

    },
    update(form, id) {

    },
    destroy(id) {

    }
}