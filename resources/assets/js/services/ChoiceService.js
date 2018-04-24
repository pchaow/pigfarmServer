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
        let req = axios.get("/api/choices/" + id, {
            params: form
        })
        return req;
    },
    getByName(name, form) {
        let req = axios.get("/api/choices/" + name, {
            params: form
        })

        return req;
    },
    store(form) {
        let req = axios.post("/api/choices", form);

        req.catch((err) => {
            let errorMsg = err.response.data.message;
            AlertService.createNotify(errorMsg,"error")
        });
        return req;
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