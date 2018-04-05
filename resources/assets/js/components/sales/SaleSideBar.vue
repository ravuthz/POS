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
                    {{ data.item.sale_price | currency($t('labels.currency')) }}
                </template>
                <template slot="qty" slot-scope="data">
                    <b-form-input v-model="data.item.qty" type="text" @change="changeQty(data.item)"></b-form-input>
                </template>
                <template slot="subtotal" slot-scope="data">
                    {{ data.item.subTotal | currency($t('labels.currency')) }}
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
                        <span class="float-left">{{ $t('labels.total') }}</span>
                        <span class="float-right">{{ total | currency($t('labels.currency')) }}</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <b-button v-b-modal.sellItem class="btn btn-xl btn-footer" :disabled="items.length < 1">
                        {{ $t('buttons.sale') }}
                    </b-button>
                </div>
            </div>
        </div>

        <b-modal centered id="removeItem"
                 :title="$t('modals.delete.title')"
                 :ok-title="$t('modals.delete.okTitle')"
                 :cancel-title="$t('modals.cancelTitle')"
                 @ok="removeItem(itemRemove)">
            <div v-html="$t('modals.delete.content', { item: itemRemove.name })"></div>
        </b-modal>

        <b-modal centered id="clearAllItem"
                 :title="$t('modals.clear.title')"
                 :ok-title="$t('modals.delete.okTitle')"
                 :cancel-title="$t('modals.cancelTitle')"
                 @ok="clearSaleProduct()">
            <div v-html="$t('modals.clear.content')"></div>
        </b-modal>

        <b-modal centered id="sellItem"
                 :title="$t('modals.sale.title')"
                 :ok-title="$t('modals.sale.okTitle')"
                 :cancel-title="$t('modals.cancelTitle')"
                 @ok="createSaleProduct()">

            <b-table :items="loadItems" :fields="fields" :value.sync="items">
                <template slot="no" slot-scope="data">
                    {{ data.index + 1 }}
                </template>
                <template slot="sale_price" slot-scope="data">
                    {{ data.item.sale_price | currency($t('labels.currency')) }}
                </template>
                <template slot="qty" slot-scope="data">
                    <b-form-input v-model="data.item.qty" type="text" @change="changeQty(data.item)"></b-form-input>
                </template>
                <template slot="subtotal" slot-scope="data">
                    {{ data.item.subTotal | currency($t('labels.currency')) }}
                </template>
            </b-table>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-block btn-total">
                        <span class="float-left">{{ $t('labels.total') }}</span>
                        <span class="float-right">{{ total | currency($t('labels.currency')) }}</span>
                    </button>
                </div>
            </div>
        </b-modal>

    </nav>
</template>

<script>
    import {getCountOrderType, createSaleItems, updateSaleItems} from '../../api.js';

    export default {
        props: {
            value: true,
        },
        data() {
            return {
                fields: [
                    {
                        key: 'no',
                        label: this.trans('labels.no')
                    },
                    {
                        key: 'name',
                        label: this.trans('labels.name')
                    },
                    {
                        key: 'sale_price',
                        label: this.trans('labels.price'),
                        class: 'text-right'
                    },
                    {
                        key: 'qty',
                        label: this.trans('labels.qty'),
                        class: 'text-right'
                    },
                    {
                        key: 'subtotal',
                        label: this.trans('labels.subTotal'),
                        class: 'text-right'
                    },
                    {
                        key: 'actions',
                        label: ' ',
                        class: 'text-right'
                    }
                ],
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
        updated() {
            getCountOrderType().then(res => {
                this.countOrderTypeSold = res.data;
                let data = {
                    countOrderTypeSold: this.countOrderTypeSold
                };
                this.$bus.$emit('SaleSideBar.updated', data);
            });
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
                let items = this.items;
                console.log("items before prints: ", this.items);
                createSaleItems({items});
                window.print();
                this.clearSaleProduct();
            },
            updateSaleProduct(id) { // don't implement yet
                let items = this.items;
                updateSaleItems(id, {items});
                window.print();
                this.clearSaleProduct();
            },
            clearSaleProduct: function () {
                this.$store.dispatch('clearAllItems');
            },
            trans(code) {
                return this.$i18n.t(code);
            }
        }
    }

</script>
