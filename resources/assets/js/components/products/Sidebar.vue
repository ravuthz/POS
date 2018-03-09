<template>
    <nav id="sidebar" v-bind:class="{ active : showRightSidebar }">
        <div class="sidebar-header">
            <div class="container-fluid">
                <section class="row">
                    <div class="col-md-8">
                        <h1>Simple POS</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group float-right mt-2" role="group">
                             <b-button size="lg" v-b-modal.clearAllItem class="float-right"><i class="fa fa-trash"></i></b-button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <b-table :items="items" :fields="fields" :value.sync="items">
            <template slot="no" slot-scope="data">
                {{ data.index + 1 }}
            </template>
            <template slot="sale_price" slot-scope="data">
                {{ data.item.sale_price | currency('R ') }}
            </template>
            <template slot="qty" slot-scope="data">
                <b-form-input v-model="data.item.qty" type="text" @change="changeQty(data.item)"></b-form-input>
            </template>
            <template slot="subtotal" slot-scope="data">
                {{ data.item.subTotal | currency('R ') }}
            </template>
            <template slot="actions" slot-scope="data">
                <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                <b-button size="sm"  v-b-modal.removeItem  @click="itemRemove=data.item" class="mr-1 btn-danger">
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
        </b-table>
        <div class="footerSidebar row" >
            <div class="col-lg-12 total">
                <span class="float-left">Total</span>
                <span class="float-right">{{ total | currency('R ') }}</span>
            </div>
            <b-button v-b-modal.sellItem class="buttonPrint">Sale</b-button>
        </div>
        <b-modal centered  id="removeItem"
            title="Item"
            @ok="removeItem(itemRemove)">
            Do you want to delete this item?
        </b-modal>

        <b-modal centered  id="clearAllItem"
            title="Clear"
            @ok="clearSaleProduct()">
            Do you want to clear all item?
        </b-modal>

        <b-modal centered  id="sellItem"
            title="Sale"
            ok-title="Save & Print"
            @ok="createSaleProduct()">
            Accept sale?

        </b-modal>
    </nav>
</template>

<script>

    export default{
        props: {
            items: {
                type: Array
            }
        },
        data () {
            return {
                fields: [
                    {
                        key: 'no',
                        label: '#'
                    }
                    ,
                    {
                        key:'name',
                    },
                    {
                        key:'sale_price',
                        label: 'Price',
                        class: 'text-right'
                    },
                    {
                        key:'qty',
                        class: 'text-right'
                    },
                    {
                        key:'subtotal',
                        class: 'text-right'
                    },
                    {
                        key: 'actions',
                        label: ' ',
                        class: 'text-right'
                    }
                ],
                showRightSidebar: false,
                total: 0.00,
                productName: null,
            }
        },
        mounted() {
            this.loadItemsStorage();
            this.sumItemsPriceTotal();
        },
        methods: {
            setStorage(key, value) {
                var item = JSON.stringify(value);
                window.localStorage.setItem(key, item);
            },
            getStorage(key, defaultValue) {
                var item = window.localStorage.getItem(key);
                if (item) {
                    return JSON.parse(item);
                } else {
                    return defaultValue;
                }
            },
            loadItemsStorage() {
                let oldItems = this.getStorage('items', []);
                if (oldItems.length > 0 && this.items.length <= 0) {
                    this.items = oldItems;
                }
                this.updateItemsStorage();
            },
            updateItemsStorage() {
                this.setStorage('items', this.items);
            },
            sumItemsPriceTotal() {
                let total = 0;
                this.items.map(item => {
                    item.subTotal = parseInt(item.qty) * parseFloat(item.sale_price);
                    total += item.subTotal;
                });
                this.total = total;
            },
            removeItem(product) {
                let found = this.items.findIndex(item => item.id == product.id);
                console.log("found: ", found)
                if (found >= 0) {
                    this.items.splice(found, 1);
                }
                this.sumItemsPriceTotal();
                this.updateItemsStorage();
            },
            changeQty(product) {
                let found = this.items.find(item => item.id == product.id);
                if (found) {
                    found.qty = parseInt(product.qty);
                }
                this.sumItemsPriceTotal();
                this.updateItemsStorage();
            },
            createSaleProduct() {
                let data = {
                    items: this.items,
                    total: this.total
                };

                axios.post('/api/sales', data).then(res => {
                    console.log("Order: ", res.data);
                });
                this.clearSaleProduct();
                // this.setStorage('items', []);
                // this.items = [];
            },
            clearSaleProduct: function() {
                console.log("clearSaleProduct : ", this.items);
                this.items = [];
                localStorage.clear();
                this.sumItemsPriceTotal();
            }
        }
    }

</script>
