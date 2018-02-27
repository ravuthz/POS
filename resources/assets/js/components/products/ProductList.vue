<template>
    <div class="products">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <b-table striped hover responsive :items="tableProvider" :fields="fields"  
             :per-page="perPage" :current-page="currentPage" />
        
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" />
        
    </div>
</template>

<script>
// import axios from 'axios';

export default {
    data() {
        return {
            loading: false,
            error: null,
            items: null,
            item: null,
            fields: ['id', 'name', 'image', 'buy_price', 'sale_price', 'category_id'],
            
            perPage: 12,
            totalRows: 12,
            currentPage: 1,
        };
    },
    created() {
        // this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.data = null;
            this.loading = true;
            axios.get('/api/products').then(res => {
                this.items = res.data.data;
                this.loading = false;
            });
        },
        
        tableProvider(ctx) {
            let params = '?page=' + ctx.currentPage + '&size=' + ctx.perPage;
            this.error = this.data = null;
            this.loading = true;
            
            return axios.get('/api/products' + params).then(res => {
                this.items = res.data.data;
                this.loading = false;
                
                this.perPage = ctx.perPage;
                this.totalRows = res.data.total;
                this.currentPage = ctx.currentPage;
                
                return (this.items || []);
            }).catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });
        }
    }
}
</script>