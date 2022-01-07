<template>
    <details-section>
        <div class="grid gap-4 divide-y divide-gray-100 col-span-6">
            <div v-if="groupInventoryDetails.length" class="overflow-auto">
                <section-title :showBorder="false" class="pb-6"
                    ><template #title
                        >Group Inventory Locations Sized
                        {{ selectedSize.name }}</template
                    ></section-title
                >
                <table-table class="max-h-96 block relative overflow-auto">
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
            </div>

            <div
                v-if="individualInventoryDetails.length"
                :class="[
                    groupInventoryDetails.length ? 'pt-6' : '',
                    'overflow-auto',
                ]"
            >
                <section-title :showBorder="false" class="pb-6"
                    ><template #title
                        >Individual Inventory Locations Sized
                        {{ selectedSize.name }}</template
                    ></section-title
                >
                <table-table class="max-h-96 block relative overflow-auto">
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
                            <table-d>{{
                                inventory.place?.plant_number
                            }}</table-d>
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
    name: "AvailabilitySection",
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
            required: true,
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
    },
};
</script>
