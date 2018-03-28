export default {

    getAll() {
        return axios.get("/api/users")
    },
    getById(id) {
        return axios.get("/api/users/" + id)
    },
    getCurrentUser() {
        return axios.get('/api/user').then((r) => {
            localStorage.user = JSON.stringify(r.data)
        })
    }
}