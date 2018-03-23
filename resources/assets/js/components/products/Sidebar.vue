<template>
    <nav id="sidebar" v-bind:class="{ active : value }">

        <div class="sidebar-header">
            <section class="row">
                <div class="col-md-9">
                    <h1>Simple POS</h1>
                </div>
                <div class="col-md-3">
                    <b-button size="lg" v-b-modal.clearAllItem class="btn-sale float-right"
                              :disabled="items.length < 1">
                        <i class="fa fa-trash"></i>
                    </b-button>
                </div>
            </section>
        </div>

        <div class="sidebar-content">
            <b-table :items="loadItems" :fields="fields" :value.sync="items">
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
                    <b-button size="sm" v-b-modal.removeItem @click="itemRemove=data.item" class="mr-1 btn-danger">
                        <i class="fa fa-trash"></i>
                    </b-button>
                </template>
            </b-table>
        </div>

        <div class="sidebar-footer">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-block btn-total">
                        <span class="float-left">Total</span>
                        <span class="float-right">{{ total | currency('R ') }}</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <b-button v-b-modal.sellItem class="btn btn-xl btn-footer" :disabled="items.length < 1">Sale
                    </b-button>
                </div>
            </div>
        </div>

        <b-modal centered id="removeItem"
                 title="Item"
                 ok-title="Delete"
                 @ok="removeItem(itemRemove)">
            Do you want to delete this item <p style="color:red">{{ itemRemove.name }}?</p>
        </b-modal>

        <b-modal centered id="clearAllItem"
                 title="Clear"
                 ok-title="Clear"
                 @ok="clearSaleProduct()">
            Do you want to clear all item?
        </b-modal>

        <b-modal centered
                 id="sellItem"
                 title="Sale"
                 ok-title="Save & Print"
                 @ok="createSaleProduct()">
            <b-table :items="loadItems" :fields="fields" :value.sync="items">
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
            </b-table>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-block btn-total">
                        <span class="float-left">Total</span>
                        <span class="float-right">{{ total | currency('R ') }}</span>
                    </button>
                </div>
            </div>
        </b-modal>

    </nav>

</template>

<script>
    import { createSaleItems , updateSaleItems } from '../../api.js';

    const tableFields = [
        {
            key: 'no',
            label: '#'
        },
        {
            key: 'name',
        },
        {
            key: 'sale_price',
            label: 'Price',
            class: 'text-right'
        },
        {
            key: 'qty',
            class: 'text-right'
        },
        {
            key: 'subtotal',
            class: 'text-right'
        },
        {
            key: 'actions',
            label: ' ',
            class: 'text-right'
        }
    ];

    export default {
        props: {
            value: true,
        },
        data() {
            return {
                fields: tableFields,
                items: [],
                total: 0.00,
                itemRemove: {
                    name: null
                }
            }
        },
        created() {
            this.$store.dispatch('listItems');
        },
        computed: {
            loadItems() {
                this.items = this.$store.getters.items;
                this.total = this.$store.getters.total;
                return this.items;
            },
        },
        methods: {
            removeItem(product) {
                this.$store.dispatch('removeItem', product);
            },
            changeQty(product) {
                this.$store.dispatch('updateItem', product);
            },
            createSaleProduct() {
                // window.print();
                // this.clearSaleProduct();
                let items = this.items;

                // createSaleItems({ items }); // for create sale items
                // updateSaleItems(4, { items }); // for update sale items
            },
            clearSaleProduct: function () {
                this.$store.dispatch('clearAllItems');
            }
        }
    }

</script>
