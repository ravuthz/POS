<template>
    <b-row>
        <b-col offset-lg="8" offset-md="8" lg="2" md="2" sm="6" xs="6">
            <b-button @click="onCancelClick" class="btn-secondary btn-block">
                {{ $t(cancelLabelCode) }}
            </b-button>
        </b-col>
        <b-col lg="2" md="2" sm="6" xs="6">
            <b-button @click="onSubmitClick" class="btn btn-success btn-block">
                {{ $t(submitLabelCode) }}
            </b-button>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: "tool-bar",
        props: {
            cancelLabelCode: {
                default: 'buttons.cancel'
            },
            submitLabelCode: {
                default: 'buttons.save'
            }
        },
        methods: {
            onCancelClick(event) {
                this.$emit('onCancelClick', event);
                // this.$router.push({ name: this.backRouteName });
                this.$router.go(-1);
            },
            onSubmitClick(event) {
                this.$emit('onSubmitClick', event);
            }
        }
    }
</script>

<style scoped>

</style>