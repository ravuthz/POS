import Vue from 'vue';
import Vuex from 'vuex';

import { getAllStocks } from '../api';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        stocks: [],
    }
    getter: {
        stocks: state => state.products
    },
    mutations: {
        LIST_STOCKS(state, query) {
            getAllStocks(query).then(res => {
                state.stocks = res.data.data;
            });
        }
    },
    actions: {
        listStock(ctx, query = {}) {
            ctx.commit('LIST_STOCKS', query);
        },
    }
});
