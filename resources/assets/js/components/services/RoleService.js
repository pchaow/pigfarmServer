export default {

    getAll() {
        return axios.get("/api/roles")
    },
    getById(id) {
        return axios.get("/api/roles/" + id)
    }
}