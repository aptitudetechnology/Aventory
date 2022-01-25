<template>
    <tr tabindex="0" class="px-2">
        <table-d>
            <jet-label class="sr-only" :for="'item-selected' + form.id"
                >Select</jet-label
            >
            <jet-checkbox
                :id="'item-selected' + form.id"
                @checked="$emit('selected')"
                :value="form.id"
                v-model="selected"
                :checked="selected"
            ></jet-checkbox
        ></table-d>
        <table-d>{{ item.id }}</table-d>
        <table-d>{{ formatDate(item.created_at) }}</table-d>
        <table-d>{{ item.product.name }}</table-d>
        <table-d>{{ item.size.name }}</table-d>
        <table-d>{{ item.block.name }}</table-d>
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
            form: this.$inertia.form(this.item),
        };
    },

    watch: {
        itemSelected() {
            this.selected = this.itemSelected;
        },
    },
};
</script>
