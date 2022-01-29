<template>
    <tr tabindex="0" class="px-2">
        <table-d class="sticky left-0 bg-white">
            <jet-label class="sr-only" :for="'item-selected' + item.id"
                >Select</jet-label
            >
            <jet-checkbox
                :id="'item-selected' + item.id"
                @change="$emit('selected')"
                :value="item.id"
                v-model="selected"
                :checked="selected"
            ></jet-checkbox
        ></table-d>
        <table-d>{{ item.id }}</table-d>
        <table-d>{{ item.pivot.to_print }}</table-d>
        <table-d>{{ formatDate(item.pivot.created_at) }}</table-d>
        <table-d>{{ item.product.name }}</table-d>
        <table-d>{{ item.size.name }}</table-d>
        <table-d>{{ item.block?.name }}</table-d>
    </tr>
</template>

<script>
import TableD from "@Components/Tables/TableD.vue";
export default {
    components: {
        TableD,
    },
    props: {
        item: Object,
        itemSelected: Boolean,
    },
    data() {
        return {
            selected: this.itemSelected,
        };
    },
    emits: ["selected"],

    watch: {
        itemSelected() {
            this.selected = this.itemSelected;
        },
    },
};
</script>
