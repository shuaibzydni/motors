import { AUTH_HEADER as headers } from "../constants";

export default {
    bidRequest(productId, payload) {
        return axios.post(`/request/bid/${productId}`, payload, {headers})
    },

    bidAccept(bidId, payload) {
        return axios.post(`/accept/bid/${bidId}`, payload, {headers})
    },

    bidSold(bidId, payload) {
        return axios.post(`/sold/bid/${bidId}`, payload, {headers})
    },
}
