export default {

    getRoles() {
        return axios.get("/api/users")
    },
    getPaginate(form) {
        return axios.get("/api/users", {
            params: form
        })
    },
    getById(id) {
        return axios.get("/api/users/" + id)
    },
    store(form) {
        return axios.post('/api/users')
    },
    update(form, id) {
        return axios.put('/api/users/' + id)
    },
    destroy(id) {
        return axios.delete('/api/users/' + id)
    }
}