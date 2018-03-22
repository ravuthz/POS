export const API_SALE = '/api/sales';
export const API_PRODUCT = '/api/products';

export const getAllProducts = (params = {}) => axios.get(API_PRODUCT, { params });

export const createSaleItems = (options = {}) => axios.post(API_SALE, options);
export const updateSaleItems = (id, options = {}) => axios.patch(API_SALE + '/' + id, options);
export const deleteSaleItems = (id) => axios.delete(API_SALE + '/' + id);