<script setup>
import TableD from "@/Components/Tables/TableD.vue";
import TableRow from "@/Components/Tables/TableRow.vue";

defineProps({
    item: {
        type: Object,
    },
});
</script>

<template>
    <TableRow tabindex="0" class="px-2">
        <table-d>{{ item.id }}</table-d>
        <table-d>{{ item.quantity }}</table-d>
        <table-d>{{ item.product.name }}</table-d>
        <table-d>{{ item.size.name }}</table-d>
        <table-d>{{ item.nursery_location?.location_code }}</table-d>
        <table-d>{{ item.block.BlockDisplayName }}</table-d>
        <table-d>{{ item.place_name }}</table-d>
    </TableRow>
</template>
