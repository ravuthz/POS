<template>
    <div>
        <b-card :title="$t('orders.show')" tag="article" header-tag="h3">
            <p class="card-text text-lg-right">
                <router-link :to="{ name: 'orders.list' }" class="btn btn-secondary">
                    {{ $t('buttons.cancel') }}
                </router-link>
                <router-link :to="{ name: 'orders.update', params: {id: $route.params.id} }" class="btn btn-success">
                    {{ $t('buttons.modify') }}
                </router-link>
            </p>
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
                     :items="order.items"
            ></b-table>

        </b-card>
    </div>
</template>

<script>
    import {getOnlyOrder, getOrderTypes} from '../../api.js'

    export default {
        name: "order-show",
        data() {
            return {
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
        }
    }
</script>

<style scoped>

</style>