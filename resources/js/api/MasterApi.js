import { AUTH_HEADER as headers } from "../constants";

export default {
    list(modelName, params) {
        return axios.get(`/master/${modelName}/list`, { headers, params })
    },

    add(modelName, payload) {
        return axios.post(`/master/${modelName}`, payload, { headers })
    },

    update(modelName, masterId, payload) {
        return axios.put(`/master/${modelName}/${masterId}`, payload, {
            headers,
        })
    },

    delete(modelName, masterId) {
        return axios.delete(`/master/${modelName}/${masterId}`, { headers })
    },
}
