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
        return axios.post("/api/users", form)
    },
    update(form, id) {

        return axios.put("/api/users/" + id, form)

    },
    destroy(id) {
        return axios.delete('/api/users/' + id)
    },
    getCurrentUser() {
        return axios.get('/api/user').then((r) => {
            localStorage.user = JSON.stringify(r.data)
        })
    }
}