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
        <table-d>{{ item.quantity }}</table-d>
        <table-d>{{ formatDate(item.created_at) }}</table-d>
        <table-d>{{ formatDate(item.updated_at) }}</table-d>
        <table-d>{{ item.product.name }}</table-d>
        <table-d>{{ item.size.name }}</table-d>
        <table-d>{{ item.nursery_location?.location_code }}</table-d>
        <table-d>{{ item.block_name }}</table-d>
        <table-d>{{ item.place_name }}</table-d>
        <table-d>
            <inertia-link :href="route('inventory.show', item.id)" class="link"
                >Edit</inertia-link
            >
        </table-d>
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
