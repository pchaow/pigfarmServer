import AlertService from '../services/AlertService';

export default {

    getUsers() {
        return axios.get("/api/users")
    },
    getPaginate(form) {
        return axios.get("/api/users", {
            params: form
        })
    },
    getById(id, form) {
        return axios.get("/api/users/" + id, {
            params: form
        })
    },
    store(form) {
        let req =axios.post("/api/users", form)
        req.then((res) => {
            AlertService.createNotify("User id:" + res.data.id + " has been created", "success")
        });
        req.catch( (err) => {
            AlertService.createNotify("User cannot be created", "danger")
        });
        return req
    },
    update(form, id) {

        let req = axios.put("/api/users/" + id, form)
        req.then((res) => {
            AlertService.createNotify("User id:" + res.data.id + " has been updated", "success")
        });
        req.catch( (err) => {
            AlertService.createNotify("User id:" + err.body.data.id + " cannot be updated", "danger")
        });

        return req;

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