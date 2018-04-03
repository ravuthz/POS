<template>
    <b-form-group horizontal :label="label">
        <b-input-group>
            <b-form-input :value="keyword" @input="onSearch" :placeholder="$t('labels.searchId')"/>
            <b-btn :disabled="!keyword" @click="onClear">
                {{ $t('buttons.clear')}}
            </b-btn>
        </b-input-group>
    </b-form-group>
</template>

<script>
    export default {
        name: "search-bar",
        props: {
            label: {
                name: 'label',
                default: '',
            },
            keyword: {
                name: 'keyword',
                required: true,
            },
            // value: {
            //     name: 'value',
            //     required: true,
            // }
        },
        methods: {
            onClear() {
                this.$emit('onClear');
            },
            onSearch(text) {
                this.$emit('onSearch', text);
            },
        }
    }
</script>