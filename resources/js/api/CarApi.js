import { AUTH_HEADER as headers } from "../constants";

export default {
    carResources(params) {
        return axios.get(`/car-resources`, {headers, params})
    },

    carModels(params) {
        return axios.get(`/car-models`, {headers, params})
    },

    carStore(payload) {
        return axios.post(`/car-store`, payload, {headers})
    },

    carUpdate(carId, payload) {
        return axios.post(`/car-update/${carId}`, payload, {headers})
    },

    carList(params) {
        return axios.get(`/car-list?type=web`, {headers, params})
    },

    liveBids(params) {
        return axios.get(`/car-list?type=web&bidding=live`, {headers, params})
    },

    acceptedBids(params) {
        return axios.get(`/car-list?type=web&bidding=accepted`, {headers, params})
    },

    soldBids(params) {
        return axios.get(`/car-list?type=web&bidding=sold`, {headers, params})
    },

    carDetail(carId, params = {}) {
        return axios.get(`/car-detail/${carId}`, {headers, params})
    },

    carDelete(carId) {
        return axios.delete(`/car-delete/${carId}`, {headers})
    },
}
