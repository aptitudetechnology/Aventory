<template>
    <details-section>
        <div
            class="grid gap-4 divide-y divide-gray-100 col-span-6 overflow-hidden"
        >
            <div v-if="!areInventoryDetails" class="flex justify-center">
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-500">
                        No Inventory
                    </h3>
                    <p class="text-gray-500">
                        There are no inventory items in this size.
                    </p>
                </div>
            </div>
            <div v-if="groupInventoryDetails.length" class="overflow-hidden">
                <section-title
                    ><template #title
                        >Group Inventory Sized {{ selectedSize.name }}</template
                    ></section-title
                >
                <table-table
                    class="max-h-96 block w-full relative overflow-auto"
                >
                    <table-head class="z-30">
                        <table-h class="sticky left-0 bg-white">ID</table-h>
                        <table-h>Location</table-h>
                        <table-h>Qty</table-h>
                        <table-h>Ready</table-h>
                    </table-head>
                    <tbody>
                        <tr v-for="inventory in groupInventoryDetails">
                            <table-d class="sticky left-0 z-10 bg-white">{{
                                inventory.id
                            }}</table-d>
                            <table-d class="truncate">{{
                                inventory.block?.name
                            }}</table-d>
                            <table-d class="truncate max-w-20">{{
                                inventory.quantity
                            }}</table-d>
                            <table-d
                                :data-tip="
                                    'Inventory is estimated to be ready to sell by: ' +
                                    formatDate(inventory.ready_date)
                                "
                                class="tooltip tooltip-left tooltip-small z-20"
                                >{{ formatDate(inventory.ready_date) }}</table-d
                            >
                        </tr>
                    </tbody>
                </table-table>
            </div>

            <div
                v-if="individualInventoryDetails.length"
                :class="[
                    groupInventoryDetails.length ? 'pt-6' : '',
                    'overflow-hidden',
                ]"
            >
                <section-title
                    ><template #title
                        >Individual Inventory Sized
                        {{ selectedSize.name }}</template
                    ></section-title
                >
                <table-table
                    class="max-h-96 block w-full relative overflow-auto"
                >
                    <table-head class="z-30">
                        <table-h class="sticky left-0 bg-white">ID</table-h>
                        <table-h>Location</table-h>
                        <table-h>Row</table-h>
                        <table-h>Plant #</table-h>
                        <table-h>Ready</table-h>
                    </table-head>

                    <tbody>
                        <tr v-for="inventory in individualInventoryDetails">
                            <table-d class="sticky left-0 z-10 bg-white">{{
                                inventory.id
                            }}</table-d>
                            <table-d class="truncate max-w-20">{{
                                inventory.block?.name
                            }}</table-d>
                            <table-d class="truncate max-w-20">{{
                                inventory.place?.row_number
                            }}</table-d>
                            <table-d class="truncate max-w-20">{{
                                inventory.place?.plant_number
                            }}</table-d>
                            <table-d
                                :data-tip="
                                    'Inventory is estimated to be ready to sell by: ' +
                                    formatDate(inventory.ready_date)
                                "
                                class="tooltip tooltip-left tooltip-small z-20"
                                >{{ formatDate(inventory.ready_date) }}</table-d
                            >
                        </tr>
                    </tbody>
                </table-table>
            </div>
        </div>
    </details-section>
</template>
<script>
import SectionTitle from "@/Jetstream/SectionTitle.vue";
import TableTable from "@/Components/Tables/TableTable.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableH from "@/Components/Tables/TableH.vue";
import TableD from "@/Components/Tables/TableD.vue";
export default {
    components: {
        SectionTitle,
        TableTable,
        TableHead,
        TableH,
        TableD,
    },
    props: {
        product: {
            type: Object,
            required: true,
        },
        inventory: {
            type: Array,
            required: true,
        },
        selectedSize: {
            type: Object,
            required: false,
        },
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
        areInventoryDetails() {
            return (
                this.groupInventoryDetails.length ||
                this.individualInventoryDetails.length
            );
        },
    },
};
</script>
