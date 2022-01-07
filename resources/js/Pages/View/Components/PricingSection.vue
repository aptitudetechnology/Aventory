<template>
    <div class="pt-6 overflow-auto">
        <section-title :showBorder="false" class="pb-6"
            ><template #title>Pricing Details</template></section-title
        >
        <table-table class="col-span-6 overflow-auto">
            <table-head>
                <table-h>Size</table-h>
                <table-h v-if="!priceLevels.length">Price</table-h>
                <table-h
                    v-for="priceLevel in priceLevels"
                    :key="priceLevel.id"
                    :title="priceLevel.name + ' pricing'"
                    >{{ priceLevel.name }}</table-h
                >
            </table-head>
            <tbody>
                <tr
                    @click="updateSize(size.size_id)"
                    @focus="updateSize(size.size_id)"
                    :tabindex="index + 1"
                    v-for="(size, index) in productQuantities"
                    :class="[
                        'cursor-pointer hover:bg-gray-50',
                        size.size_id == selectedSize.id ? 'bg-gray-50' : '',
                    ]"
                >
                    <table-d>{{ size.size_name }}</table-d>
                    <table-d v-if="!priceLevels.length"
                        >${{ getSizeBasePrice(size.size_id) }}</table-d
                    >
                    <table-d
                        v-for="priceLevel in priceLevels"
                        :key="priceLevel.id"
                        :title="priceLevel.name + ' pricing'"
                        >{{
                            formatMoney(
                                getSizePriceForPriceLevel(
                                    size.size_id,
                                    priceLevel
                                )
                            )
                        }}</table-d
                    >
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
        product: {
            type: Object,
            required: true,
        },
        productQuantities: {
            type: Array,
            required: true,
        },
        selectedSize: {
            type: Object,
            required: true,
        },
        priceLevels: {
            type: Array,
            required: true,
        },
    },
    methods: {
        updateSize(sizeId) {
            this.$emit("updateSize", sizeId);
        },
        getSizeBasePrice(sizeId) {
            const basePrice = this.product.base_prices.find((basePrice) => {
                return basePrice.size_id == sizeId;
            });
            return basePrice ? basePrice.unit_price : 0.0;
        },
        getSizePriceForPriceLevel(sizeId, level) {
            return (
                (this.getSizeBasePrice(sizeId) * level.percentage_more) / 100 +
                this.getSizeBasePrice(sizeId)
            );
        },
    },
};
</script>
