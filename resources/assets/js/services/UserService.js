export default {

    getUsers() {
        return axios.get("/api/users")
    },
    getPaginate(form) {
        return axios.get("/api/users", {
            params: form
        })
    },
    getById(id,form) {
        return axios.get("/api/users/" + id, {
            params: form
        })
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
        if (localStorage.key('user')) {
            return localStorage.user
        } else {
            return axios.get('/api/user').then((r) => {
                localStorage.user = JSON.stringify(r.data)
            })
        }


    }
}