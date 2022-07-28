<template>
    <div class="grid gap-6 col-span-6 grid-cols-12 items-start">
        <div class="lg:col-span-7 col-span-12 sticky top-0">
            <details-section class="h-full">
                <div class="grid gap-4 divide-y divide-gray-100">
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

        <div class="lg:col-span-5 col-span-12">
            <ProductOrdersSection :product="product" :size="selectedSize" />
            <inventory-locations-section
                :product="product"
                :inventory="inventory"
                :selected-size="selectedSize"
            />
        </div>
    </div>
</template>
<script>
import DetailsSection from "@/Components/DetailsSection.vue";
import AvailabilitySection from "@/Pages/View/Components/AvailabilitySection.vue";
import PricingSection from "@/Pages/View/Components/PricingSection.vue";
import InventoryLocationsSection from "@/Pages/View/Components/InventoryLocationsSection.vue";
import ProductOrdersSection from "@/Pages/View/Components/ProductOrdersSection.vue";
export default {
    components: {
        DetailsSection,
        AvailabilitySection,
        PricingSection,
        InventoryLocationsSection,
        ProductOrdersSection,
    },
    data() {
        return {
            product: this.$page.props.product,
            productQuantities: this.$page.props.productQuantities,
            inventorySizes: this.$page.props.inventorySizes,
            inventory: this.$page.props.inventory,
            selectedSize: this.$page.props.inventorySizes[0] ?? null,
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
