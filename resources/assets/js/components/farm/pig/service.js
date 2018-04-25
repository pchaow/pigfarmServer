import AlertService from '../../../services/AlertService';

export default {

    getPigs() {
        return axios.get("/api/farm/pigs")
    },
    getPaginate(form) {
        return axios.get("/api/farm/pigs", {
            params: form
        })
    },
    getById(id, form) {
        return axios.get("/api/farm/pigs/" + id, {
            params: form
        })
    },
    store(form) {
        let req = axios.post("/api/farm/pigs", form)
        req.then((res) => {
            AlertService.createNotify("Pig id:" + res.data.id + " has been created", "success")
        });
        req.catch((err) => {
            AlertService.createNotify("Pig cannot be created", "error")
        });
        return req
    },
    update(form, id) {

        let req = axios.put("/api/farm/pigs/" + id, form)
        req.then((res) => {
            AlertService.createNotify("Pig id:" + res.data.id + " has been updated", "success")
        });
        req.catch((err) => {
            AlertService.createNotify("Pig id:" + err.body.data.id + " cannot be updated", "error")
        });

        return req;

    },
    destroy(id) {
        return axios.delete('/api/farm/pigs/' + id)
    },

}