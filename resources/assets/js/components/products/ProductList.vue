<template>
    <div id="content">
        <router-view></router-view>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="row">
                        <button type="button" id="sidebarCollapse" v-bind:class="{ active : showRightSidebar }" class="navbar-btn col-lg-1 col-md-2"  @click="topCloseClick">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div class="col-lg-11 col-md-10 rightSearch">
                            <b-form-input placeholder="Search product here..." v-model="productName" @keyup.native="searchProduct(productName)"></b-form-input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-6"  v-for="product in getAllProductsFromStore">
                        <div class="card" @click="addItem(product)">
                            <span class="badge">{{ product.sale_price }}</span>
                            <img class="card-img-top" :src="product.image">
                            <div class="card-block">
                                <p class="card-text">{{ product.name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <template>
                    <div>
                        <b-pagination size="md" @change="changePage" :total-rows="totalRows" :per-page="perPage"></b-pagination>
                  </div>
                </template>
            </div>
        </nav>
    </div>
</template>
<script>

    export default {
        props:{
            items:{
                type:Array
            }
        },
        data(){
            return {
                products: [],
                showRightSidebar: false,
                perPage: 12,
                productName: null,
                totalRows: null,
            }
        },
        created() {
            this.$store.dispatch('listProduct', 1);

        },
        computed: {
            getAllProductsFromStore() {
                this.products = this.$store.getters.products;
                this.totalRows = this.$store.getters.totalRows;
                return this.products;
            }
        },
        methods:{
            queryParams(url, query = {}) {
                let params = [];
                for (let q in query) {
                    if (query.hasOwnProperty(q)) {
                        params.push(q + '=' + query[q]);
                    }
                }
                if (params.length > 0) {
                    url += '?';
                    url += params.join('&');
                }
                return url;
            },
            searchProduct: function(name) {
                this.$store.dispatch('listProduct',{filter: name});
            },
            changePage (pageNum) {
                this.$store.dispatch('listProduct', {page: pageNum});
            },
            topCloseClick() {
                this.showRightSidebar = !this.showRightSidebar;
                this.$emit('onTopCloseClick', this.showRightSidebar);
            },
            addItem(product) {
                this.$store.dispatch('addItem', product);
                this.$store.dispatch('totalItemPrice');
            },
        }
    }

</script>
