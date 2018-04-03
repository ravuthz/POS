<template>
    <div>
        <b-card :title="$t('orders.' + $route.meta.mode)" tag="article" header-tag="h3">

            <tool-bar submitLabelCode="buttons.save" @onSubmitClick="saveOrderItems"></tool-bar>

            <b-row>
                <b-col lg="6" xs="12">
                    <h5 class="card-title text-xs-center"
                        v-html="$t('labels.orderIdType', { id: order.id, type: orderTypes[order.type] })"></h5>
                </b-col>
                <b-col lg="6" xs="12">
                    <p class="card-text text-lg-right text-xs-center"
                       v-html="$t('labels.createdAtBy', { at: order.created_at, by: order.created_by })"></p>
                </b-col>
            </b-row>

            <b-table show-empty
                     stacked="sm"
                     :fields="fields"
                     :items="order.items"
            >
                <template slot="x" slot-scope="data">
                    <b-button size="sm" variant="danger" @click="deleteItem(item)">
                        <i class="fa fa-trash"></i>
                    </b-button>
                </template>
                <template slot="product_id" slot-scope="data">
                    <b-form-select v-model="data.item.product_id" :options="productList"></b-form-select>
                </template>
                <template slot="price" slot-scope="data">
                    <b-form-input class="text-right" type="number" v-model="data.item.price"></b-form-input>
                </template>
                <template slot="quantity" slot-scope="data">
                    <b-form-input class="text-center" type="number" v-model="data.item.quantity"></b-form-input>
                </template>
                <template slot="subTotal" slot-scope="data">
                    {{ data.item.subTotal | currency('R ') }}
                </template>
            </b-table>

            <grand-total :grand-total="grandTotal" @onAddItemClick="addNewItem" showAddButton="true"></grand-total>

        </b-card>
    </div>
</template>

<script>
    import {getOnlyOrder, getOrderTypes, getProductsList} from '../../api.js'
    import ToolBar from "../core/ToolBar";
    import GrandTotal from "../core/GrandTotal";

    export default {
        components: {ToolBar, GrandTotal},
        name: "order-show",
        data() {
            return {
                fields: [
                    {
                        key: 'x',
                        label: ' '
                    },
                    'product_id',
                    'quantity',
                    'price',
                    'subTotal'
                ],
                order: {
                    id: null,
                    type: null,
                    items: [],
                    no_of_items: null,
                    created_at: null,
                    created_by: null,
                },
                orderTypes: [],
                productList: [],
                indeterminate: false
            };
        },
        beforeCreate() {
            getOrderTypes().then(res => this.orderTypes = res.data.data);
            getProductsList().then(res => this.productList = res.data.data);

            console.log("beforeCreate $route.meta.mode: ", this.$route.meta.mode);
            if (this.$route.meta.mode === 'update') {
                getOnlyOrder(this.$route.params.id).then(res => this.order = res.data.data);
            } else {

            }
        },
        computed: {
            grandTotal() {
                let total = 0;
                this.order.items.map(item => {
                    item.subTotal = Number(item.price) * Number(item.quantity);
                    total += Number(item.subTotal);
                });
                return total;

                return this.order.items.reduce((total, item) => total + (Number(item.price) * Number(item.quantity)), 0);
            }
        },
        methods: {
            addNewItem() {
                const length = this.order.items.length;
                if (length > 0) {
                    const lastItem = this.order.items[length - 1];
                    this.order.items.push(lastItem);
                } else {
                    this.order.items.push({
                        product_id: '',
                        product_name: '',
                        price: 0,
                        quantity: 1
                    });
                }

            },
            deleteItem(item) {
                console.log("deleteItem(item): ", item);
            },
            saveOrderItems(event) {
                console.log("saveOrderItems(event): ", event);
            }
        }
    }
</script>

<style scoped>
    .table .form-control {
        border: 1px solid white !important;
    }
    .table .form-control:hover {
        border: 1px solid seagreen !important;
    }
    .table th:nth-child(3),
    .table th:nth-child(4),
    .table th:last-child {
        text-align: right !important;
    }
</style>