<template>
    <div class="grid gap-6 col-span-6 grid-cols-6">
        <div class="lg:col-span-3 col-span-6">
            <details-section class="h-full">
                <div class="grid gap-4 divide-y divide-gray-100 col-span-6">
                    <div class="overflow-auto">
                        <section-title :showBorder="false" class="pb-6"
                            ><template #title
                                >Inventory Availability</template
                            ></section-title
                        >
                        <table-table class="col-span-6 overflow-auto">
                            <table-head>
                                <table-h>Size</table-h>
                                <table-h>Available</table-h>
                                <table-h>On Hold</table-h>
                                <table-h>Sold</table-h>
                                <table-h
                                    title="All available inventory with inventory ready date in the future."
                                    >Total</table-h
                                >
                            </table-head>
                            <tbody>
                                <tr
                                    @click="selectedSize = size"
                                    @focus="selectedSize = size"
                                    :tabindex="index + 1"
                                    v-for="(size, index) in inventorySizes"
                                    :class="[
                                        'cursor-pointer hover:bg-gray-50',
                                        size.id == selectedSize.id
                                            ? 'bg-gray-50'
                                            : '',
                                    ]"
                                >
                                    <table-d>{{ size.name }}</table-d>
                                    <table-d>{{
                                        size.available_count
                                    }}</table-d>
                                    <table-d>{{ onHold(size.id) }}</table-d>
                                    <table-d>{{ sold(size.id) }}</table-d>
                                    <table-d>{{
                                        size.total_inventory
                                    }}</table-d>
                                </tr>
                            </tbody>
                        </table-table>
                    </div>

                    <div class="pt-6 overflow-auto">
                        <section-title :showBorder="false" class="pb-6"
                            ><template #title
                                >Pricing Details</template
                            ></section-title
                        >
                        <table-table class="col-span-6 overflow-auto">
                            <table-head>
                                <table-h>Size</table-h>
                                <table-h v-if="!priceLevels.length"
                                    >Price</table-h
                                >
                                <table-h
                                    v-for="priceLevel in priceLevels"
                                    :key="priceLevel.id"
                                    :title="priceLevel.name + ' pricing'"
                                    >{{ priceLevel.name }}</table-h
                                >
                            </table-head>
                            <tbody>
                                <tr
                                    @click="selectedSize = size"
                                    @focus="selectedSize = size"
                                    :tabindex="index + 1"
                                    v-for="(size, index) in inventorySizes"
                                    :class="[
                                        'cursor-pointer hover:bg-gray-50',
                                        size.id == selectedSize.id
                                            ? 'bg-gray-50'
                                            : '',
                                    ]"
                                >
                                    <table-d>{{ size.name }}</table-d>
                                    <table-d v-if="!priceLevels.length"
                                        >${{ getSizeBasePrice(size) }}</table-d
                                    >
                                    <table-d
                                        v-for="priceLevel in priceLevels"
                                        :key="priceLevel.id"
                                        :title="priceLevel.name + ' pricing'"
                                        >${{
                                            (priceLevel.percentage_more / 100) *
                                                getSizeBasePrice(size) +
                                            getSizeBasePrice(size)
                                        }}</table-d
                                    >
                                </tr>
                            </tbody>
                        </table-table>
                    </div>
                </div>
            </details-section>
        </div>

        <div class="lg:col-span-3 col-span-6">
            <details-section>
                <div class="grid gap-4 divide-y divide-gray-100 col-span-6">
                    <div
                        v-if="groupInventoryDetails.length"
                        class="overflow-auto"
                    >
                        <section-title :showBorder="false" class="pb-6"
                            ><template #title
                                >Group Inventory Details Sized
                                {{ selectedSize.name }}</template
                            ></section-title
                        >
                        <table-table
                            class="max-h-96 block relative overflow-auto"
                        >
                            <table-head>
                                <table-h>Product ID</table-h>
                                <table-h>Block Location</table-h>
                                <table-h>Quantity</table-h>
                            </table-head>
                            <tbody>
                                <tr v-for="inventory in groupInventoryDetails">
                                    <table-d>{{ inventory.id }}</table-d>
                                    <table-d>{{
                                        inventory.block?.name
                                    }}</table-d>
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
                                >Individual Inventory Details Sized
                                {{ selectedSize.name }}</template
                            ></section-title
                        >
                        <table-table
                            class="max-h-96 block relative overflow-auto"
                        >
                            <table-head>
                                <table-h>Product ID</table-h>
                                <table-h>Block Location</table-h>
                                <table-h>Row</table-h>
                                <table-h>Plant #</table-h>
                            </table-head>

                            <tbody>
                                <tr
                                    v-for="inventory in individualInventoryDetails"
                                >
                                    <table-d>{{ inventory.id }}</table-d>
                                    <table-d>{{
                                        inventory.block?.name
                                    }}</table-d>
                                    <table-d>{{
                                        inventory.place?.row_number
                                    }}</table-d>
                                    <table-d>{{
                                        inventory.place?.plant_number
                                    }}</table-d>
                                </tr>
                            </tbody>
                        </table-table>
                    </div>
                </div>
            </details-section>
        </div>
    </div>
</template>
<script>
import TableH from "@/Components/Tables/TableH.vue";
import TableD from "@/Components/Tables/TableD.vue";
import TableTable from "@/Components/Tables/TableTable.vue";
import DetailsSection from "@Components/DetailsSection.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import SectionTitle from "@/Jetstream/SectionTitle.vue";
export default {
    components: {
        TableH,
        TableD,
        TableTable,
        DetailsSection,
        TableHead,
        SectionTitle,
    },
    data() {
        return {
            product: this.$page.props.product,
            inventorySizes: this.$page.props.inventorySizes,
            inventory: this.$page.props.inventory,
            selectedSize: this.$page.props.inventorySizes[0],
            priceLevels: this.$page.props.priceLevels,
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
        getSizeBasePrice(size) {
            const basePrice = this.product.base_prices.find((basePrice) => {
                return basePrice.size_id == size.id;
            });
            return basePrice ? basePrice.unit_price : 0.0;
        },
    },
};
</script>
