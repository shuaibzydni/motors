import { AUTH_HEADER as headers } from "../constants";

export default {
    favouriteAdd(productId, payload = {}) {
        return axios.post(`/favourites/${productId}`, payload, {headers})
    },
}
