export const API_PRODUCT = '/api/products';

export const getAllProducts = function(params = {}) {
    return axios.get(API_PRODUCT, { params });
}
