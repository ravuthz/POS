export const API_SALE = '/api/sales';
export const API_PRODUCT = '/api/products';
export const API_ORDER_TYPE = '/api/order-types';
export const API_PRODUCT_LIST = '/api/list-products';
export const API_ORDER = '/api/orders';
export const API_STOCK = '/api/stocks';

export const getAllProducts = (params = {}) => axios.get(API_PRODUCT, { params });
export const createSaleItems = (options = {}) => axios.post(API_SALE, options);
export const updateSaleItems = (id, options = {}) => axios.patch(API_SALE + '/' + id, options);
export const deleteSaleItems = (id) => axios.delete(API_SALE + '/' + id);

export function get(url, params) {
    return axios({
        method: 'GET',
        url: url,
        params: params
    })
}

export function post(url, data) {
    return axios({
        method: 'POST',
        url: url,
        data: data
    })
}

export const getAuth = () => axios.get('/api/auth');

export const getCountOrderType = () => axios.get('/api/count/orders?field=type&value=3');

export const getProductsList = () => axios.get(API_PRODUCT_LIST);
export const getOrderTypes = () => axios.get(API_ORDER_TYPE);
export const getAllOrders = (params = {}) => axios.get(API_ORDER, { params });
export const getOnlyOrder = (id) => axios.get(`${API_ORDER}/${id}`);
