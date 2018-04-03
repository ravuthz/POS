<template>
    <b-row>
        <b-col v-if="showAddButton" lg="6" xs="12">
            <b-button size="sm" variant="success" @click="onAddItemClick">
                {{ $t('labels.addMoreItem') }}
            </b-button>
        </b-col>
        <b-col :offset-lg="showAddButton ? 0 : 6" lg="6" xs="12">
            <b-row>
                <b-col class="text-lg-right">
                    <strong>{{ $t('labels.grandTotal') }}</strong>
                </b-col>
                <b-col class="text-right">
                    <strong>{{ grandTotal | currency('R ') }}</strong>
                </b-col>
            </b-row>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: "grand-total",
        props: ['grandTotal', 'showAddButton'],
        methods: {
            onAddItemClick(event) {
                this.$emit('onAddItemClick', event);
            }
        }
    }
</script>