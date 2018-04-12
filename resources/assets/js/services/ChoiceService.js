import AlertService from '../services/AlertService';

export default {

    getChoices() {
        return axios.get("/api/choices")
    },
    getPaginate(form) {
        return axios.get("/api/choices", {
            params: form
        })
    },
    getById(id, form) {
        return axios.get("/api/choices/" + id, {
            params: form
        })
    },
    getByName(name, form) {
        return axios.get("/api/choices/" + name, {
            params: form
        })
    },
    store(form) {
        return axios.post("/api/choices", form)
    },
    update(form, id) {

        let req = axios.put("/api/choices/" + id, form)
        req.then(res => {
            AlertService.createNotify("Choice id:" + res.data.id + " has been updated", "success")
        });

        return req;

    },
    destroy(id) {
        return axios.delete('/api/choices/' + id)
    },
}