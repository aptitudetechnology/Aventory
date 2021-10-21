<template>
    <details-section class="lg:col-span-3 col-span-6" :showTitleBorder="false">
        <template #title>Inventory Availability</template>
        <table-table class="col-span-6">
            <table-head>
                <table-h>Size</table-h>
                <table-h>Available</table-h>
                <table-h>On Hold</table-h>
                <table-h>Sold</table-h>
            </table-head>
            <tbody>
                <tr
                    @click="selectedSize = size"
                    v-for="size in inventorySizes"
                    :class="[
                        'cursor-pointer hover:bg-gray-50',
                        size.id == selectedSize.id ? 'bg-gray-50' : '',
                    ]"
                >
                    <table-d>{{ size.name }}</table-d>
                    <table-d>{{ available(size.id) }}</table-d>
                    <table-d>{{ onHold(size.id) }}</table-d>
                    <table-d>{{ sold(size.id) }}</table-d>
                </tr>
            </tbody>
        </table-table>
    </details-section>
    <div class="lg:col-span-3 col-span-6">
        <details-section
            v-if="groupInventoryDetails.length"
            :showTitleBorder="false"
        >
            <template #title
                >Group Inventory Details Sized {{ selectedSize.name }}</template
            >
            <table-table
                class="col-span-6 max-h-96 block relative overflow-auto"
            >
                <table-head>
                    <table-h>Product ID</table-h>
                    <table-h>Block Location</table-h>
                    <table-h>Quantity</table-h>
                </table-head>
                <tbody>
                    <tr v-for="inventory in groupInventoryDetails">
                        <table-d>{{ inventory.id }}</table-d>
                        <table-d>{{ inventory.block?.name }}</table-d>
                        <table-d>{{ inventory.quantity }}</table-d>
                    </tr>
                </tbody>
            </table-table>
        </details-section>
        <details-section
            v-if="individualInventoryDetails.length"
            :showTitleBorder="false"
        >
            <template #title
                >Individual Inventory Details Sized
                {{ selectedSize.name }}</template
            >
            <table-table
                class="col-span-6 max-h-96 block relative overflow-auto"
            >
                <table-head>
                    <table-h>Product ID</table-h>
                    <table-h>Block Location</table-h>
                    <table-h>Row</table-h>
                    <table-h>Plant #</table-h>
                </table-head>

                <tbody>
                    <tr v-for="inventory in individualInventoryDetails">
                        <table-d>{{ inventory.id }}</table-d>
                        <table-d>{{ inventory.block?.name }}</table-d>
                        <table-d>{{ inventory.place?.row_number }}</table-d>
                        <table-d>{{ inventory.place?.plant_number }}</table-d>
                    </tr>
                </tbody>
            </table-table>
        </details-section>
    </div>
</template>
<script>
import TableH from "@/Components/TableH.vue";
import TableD from "@Components/TableD.vue";
import TableTable from "@/Components/TableTable.vue";
import DetailsSection from "@Components/DetailsSection.vue";
import TableHead from "@/Components/TableHead.vue";
export default {
    components: { TableH, TableD, TableTable, DetailsSection, TableHead },
    data() {
        return {
            inventorySizes: this.$page.props.inventorySizes,
            inventory: this.$page.props.inventory,
            selectedSize: this.$page.props.inventorySizes[0],
        };
    },
    computed: {
        groupInventoryDetails() {
            return this.inventory.filter((inventory) => {
                return (
                    inventory.size_id == this.selectedSize.id &&
                    inventory.type == "group"
                );
            });
        },
        individualInventoryDetails() {
            return this.inventory.filter((inventory) => {
                return (
                    inventory.size_id == this.selectedSize.id &&
                    inventory.type == "individual"
                );
            });
        },
    },
    methods: {
        available(sizeID) {
            return (
                this.inventory
                    .filter((inventory) => inventory.size_id == sizeID)
                    .map((item) => item.quantity)
                    .reduce((previous, current) => previous + current) -
                this.onHold(sizeID) -
                this.sold(sizeID)
            );
        },
        onHold(sizeID) {
            return 0;
        },
        sold(sizeID) {
            return 0;
        },
    },
};
</script>
