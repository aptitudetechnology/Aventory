<template>
  <products-layout>
    <div class="space-y-6">
      <div class="lg:grid lg:grid-cols-8 gap-4">
        <div class="lg:col-span-5 mb-6">
          <update-product-form :product="product" />
        </div>
        <div class="lg:col-span-3">
          <product-pricing :product="product" />
        </div>
      </div>
      <plant-features v-if="product.plant" :plant="product.plant" />
      <delete-product-form :product="product" />
    </div>
  </products-layout>
</template>
<script>
import DeleteProductForm from "./DeleteProductForm.vue";
import PlantFeatures from "./PlantFeatures.vue";
import ProductsLayout from "./ProductsLayout.vue";
import UpdateProductForm from "./UpdateProductForm.vue";
import ProductPricing from "./Pricing/ProductPricing.vue";

export default {
  components: {
    ProductsLayout,
    UpdateProductForm,
    DeleteProductForm,
    PlantFeatures,
    ProductPricing,
  },
  computed: {
    product() {
      return this.$page.props.product;
    },
  },
};
</script>
