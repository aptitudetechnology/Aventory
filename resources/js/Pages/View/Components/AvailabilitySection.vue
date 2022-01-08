<template>
    <div class="overflow-auto">
        <section-title
            ><template #title>Inventory Availability</template></section-title
        >
        <table-table class="col-span-6 overflow-auto">
            <table-head>
                <table-h>Size</table-h>
                <table-h>Inventory</table-h>
                <table-h>Ready</table-h>
                <table-h>On Hold</table-h>
                <table-h
                    data-tip="Quantity of inventory items that have not been removed from inventory, but are sold."
                    class="tooltip tooltip-left"
                    >Unmatched</table-h
                >
                <table-h
                    title="All available inventory with inventory ready date in the future."
                    >Available</table-h
                >
            </table-head>
            <tbody>
                <tr
                    @click="updateSize(quantity.size_id)"
                    @focus="updateSize(quantity.size_id)"
                    :tabindex="index + 1"
                    v-for="(quantity, index) in productQuantities"
                    :class="[
                        'cursor-pointer hover:bg-gray-50',
                        quantity.size_id == selectedSize.id ? 'bg-gray-50' : '',
                    ]"
                >
                    <table-d>{{ quantity.size_name }}</table-d>
                    <table-d>{{ quantity.total }}</table-d>
                    <table-d>{{ quantity.ready }}</table-d>
                    <table-d>{{ quantity.on_hold }}</table-d>
                    <table-d
                        data-tip="Inventory items that have not been removed from inventory, but are sold."
                        class="tooltip tooltip-left"
                        >{{ quantity.sold }}</table-d
                    >
                    <table-d>{{ quantity.available }}</table-d>
                </tr>
            </tbody>
        </table-table>
    </div>
</template>
<script>
import SectionTitle from "@/Jetstream/SectionTitle.vue";
import TableTable from "@/Components/Tables/TableTable.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableH from "@/Components/Tables/TableH.vue";
import TableD from "@/Components/Tables/TableD.vue";
export default {
    name: "AvailabilitySection",
    components: {
        SectionTitle,
        TableTable,
        TableHead,
        TableH,
        TableD,
    },
    props: {
        productQuantities: {
            type: Array,
            required: true,
        },
        selectedSize: {
            type: Object,
            required: true,
        },
    },
    methods: {
        updateSize(sizeId) {
            this.$emit("updateSize", sizeId);
        },
    },
};
</script>
