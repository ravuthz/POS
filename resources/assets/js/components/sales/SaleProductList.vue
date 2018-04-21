<template>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button type="button" id="sidebarCollapse" v-bind:class="{ active : showRightSidebar }"
                    class="navbar-btn col-lg-1 col-md-2" @click="topCloseClick">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link :to="{ name: 'orders.list' }"
                                     class="nav-link">
                            Sold ({{ countOrderTypeSold }})
                        </router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth.name | capitalize }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/logout">{{ $t('labels.logout') }}</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $i18n.locale | uppercase }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <button class="dropdown-item" @click="changeLanguage('kh')">KH</button>
                            <button class="dropdown-item" @click="changeLanguage('en')">EN</button>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <b-form-input aria-label="Search" :placeholder="$t('labels.searchProduct')" v-model="productName"
                                  @keyup.native="searchProduct(productName)"></b-form-input>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        {{ $t('buttons.search') }}
                    </button>
                </form>
            </div>
        </nav>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-6" v-for="product in getAllProductsFromStore">
                <div class="card" @click="addItem(product)">
                    <span class="badge">{{ product.sale_price }}</span>
                    <img class="card-img-top" :src="`images/${product.image}`">
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
</template>

<script>
    import {getAuth} from '../../api';

    export default {
        props: {
            items: {
                type: Array
            }
        },
        data() {
            return {
                showRightSidebar: false,
                perPage: 12,
                productName: null,
                totalRows: null,
                auth: {
                    id: '',
                    name: '',
                    name_kh: '',
                    email: '',
                    created_at: null,
                    updated_at: null
                },
                countOrderTypeSold: 0
            }
        },
        beforeCreate() {
            getAuth().then(res => this.auth = res.data);
        },
        created() {
            this.$store.dispatch('listProduct', {size: this.perPage});

            this.$bus.$on('SaleSideBar.updated', event => {
                console.log('SaleProductList.created: ', event);
                this.countOrderTypeSold = event.countOrderTypeSold;
            });
        },
        computed: {
            getAllProductsFromStore() {
                this.products = this.$store.getters.products;
                this.totalRows = this.$store.getters.totalRows;
                return this.products;
            }
        },
        methods: {
            searchProduct: function (name) {
                this.$store.dispatch('listProduct', {size: this.perPage, filter: name});
            },
            changePage(pageNum, productName) {
                this.$store.dispatch('listProduct', {page: pageNum, size: this.perPage, filter: this.productName});
            },
            topCloseClick() {
                this.showRightSidebar = !this.showRightSidebar;
                this.$emit('onTopCloseClick', this.showRightSidebar);
                console.log("ProductList.topCloseClick: $emit.onTopCloseClick");
            },
            addItem(product) {
                this.$store.dispatch('addItem', product);
            },
            changeLanguage(value) {
                this.$i18n.locale = value;
            }
        }
    }

</script>
