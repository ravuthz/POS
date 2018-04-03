<template>
    <div>
        <b-card :title="$t('orders.show')" tag="article" header-tag="h3">

            <tool-bar submitLabelCode="buttons.modify" @onSubmitClick="submitClick"></tool-bar>

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
                     stacked="md"
                     :fields="fields"
                     :items="order.items"
            >
                <template slot="subTotal" slot-scope="data">
                    {{ data.item.subTotal | currency('R ') }}
                </template>
            </b-table>

            <grand-total :grand-total="grandTotal"></grand-total>

        </b-card>
    </div>
</template>

<script>
    import ToolBar from "../core/ToolBar";
    import GrandTotal from "../core/GrandTotal";
    import {getOnlyOrder, getOrderTypes} from '../../api.js'


    export default {
        components: {ToolBar, GrandTotal},
        name: "order-show",
        data() {
            return {
                fields: [
                    'product_id',
                    'product_name',
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
            };
        },
        beforeCreate() {
            getOrderTypes().then(res => this.orderTypes = res.data.data);
            getOnlyOrder(this.$route.params.id).then(res => this.order = res.data.data);
        },
        computed: {
            grandTotal() {
                let total = 0;
                this.order.items.map(item => {
                    item.subTotal = Number(item.price) * Number(item.quantity);
                    total += Number(item.subTotal);
                });
                return total;
            }
        },
        methods: {
            submitClick() {
                this.$router.push({
                    name: 'orders.update',
                    params: {id: this.$route.params.id}
                });
            }
        }
    }
</script>

<style scoped>

</style>