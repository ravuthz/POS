<template>
    <div class="products">
        
        <crud-table 
            :items="tableProvider" 
            :fields="fields" 
            :perPage="perPage" 
            :totalRows="totalRows"
            :currentPage="currentPage"
            >
        </crud-table>
        
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            loading: false,
            error: null,
            items: [],
            item: null,
            // fields: ['id', 'name', 'image', 'buy_price', 'sale_price', 'category_id'],
            fields: [
                { key: 'id', label: 'Id', sortable: true },
                { key: 'name', label: 'Name', sortable: true },
                { key: 'image', label: 'Image' },
                { key: 'sale_price', label: 'Price', sortable: true },
                { key: 'category_id', label: 'Category', sortable: true },
                { key: 'actions', label: 'Actions' }
            ],
            
            perPage: 5,
            totalRows: 12,
            currentPage: 1,
        };
    },
    created() {

    },
    methods: {
        tableProvider(ctx) {
            console.log("tableProvider(ctx): ", ctx);
            
            let params = '?page=' + ctx.currentPage;
            params += '&size=' + ctx.perPage;
            params += '&sort=' + ctx.sortBy;
            params += '&desc=' + ctx.sortDesc;
            params += '&filter=' + ctx.filter;
            
            this.loading = true;
            return axios.get('/api/products' + params)
                .then(res => {
                    this.items = res.data.data;
                    this.perPage = ctx.perPage;
                    this.totalRows = res.data.meta.total;
                    this.currentPage = ctx.currentPage;
                    
                    this.loading = false;
                    return (this.items || []);
                })
                .catch(err => {
                    this.error = err.response.data.message || err.message;
                    this.loading = false;
                });
        },
        
        onSearchChange(event) {
            console.log("onSearchChange: ", event);
        }
    }
}
</script>