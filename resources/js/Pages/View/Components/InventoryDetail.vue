<template>
    <div class="grid gap-6 col-span-6 grid-cols-6">
        <div class="lg:col-span-3 col-span-6">
            <details-section class="h-full">
                <div class="grid gap-4 divide-y divide-gray-100 col-span-6">
                    <availability-section
                        :product-quantities="productQuantities"
                        :selected-size="selectedSize"
                        @update-size="updateSize"
                    />

                    <pricing-section
                        :product="product"
                        :product-quantities="productQuantities"
                        :selected-size="selectedSize"
                        :price-levels="priceLevels"
                        @update-size="updateSize"
                    />
                </div>
            </details-section>
        </div>

        <div class="lg:col-span-3 col-span-6">
            <inventory-locations-section
                :product="product"
                :inventory="inventory"
                :selected-size="selectedSize"
            />
        </div>
    </div>
</template>
<script>
import DetailsSection from "@Components/DetailsSection.vue";
import AvailabilitySection from "@/Pages/View/Components/AvailabilitySection.vue";
import PricingSection from "@/Pages/View/Components/PricingSection.vue";
import InventoryLocationsSection from "@/Pages/View/Components/InventoryLocationsSection.vue";
export default {
    components: {
        DetailsSection,
        AvailabilitySection,
        PricingSection,
        InventoryLocationsSection,
    },
    data() {
        return {
            product: this.$page.props.product,
            productQuantities: this.$page.props.productQuantities,
            inventorySizes: this.$page.props.inventorySizes,
            inventory: this.$page.props.inventory,
            selectedSize: this.$page.props.inventorySizes[0],
            priceLevels: this.$page.props.priceLevels,
        };
    },
    methods: {
        updateSize(sizeId) {
            this.selectedSize = this.inventorySizes.find(
                (size) => size.id == sizeId
            );
        },
    },
};
</script>
