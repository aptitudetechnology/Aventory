<template>
  <products-layout>
    <div v-if="!editingPricing" class="space-y-6">
      <jet-button @click="editingPricing = true" class="ml-4 sm:ml-0"
        >Edit Pricing</jet-button
      >
      <update-product-form :product="product" />

      <plant-features v-if="product.plant" :plant="product.plant" />
      <delete-product-form :product="product" />
    </div>
    <div v-else class="space-y-6">
      <jet-button @click="editingPricing = false" class="ml-4 sm:ml-0"
        >Back to Details</jet-button
      >
      <product-pricing :product="product" :category="category" />
    </div>
  </products-layout>
</template>
<script>
import JetButton from "@/Jetstream/Button.vue";
import DeleteProductForm from "./DeleteProductForm.vue";
import PlantFeatures from "./PlantFeatures.vue";
import ProductsLayout from "./ProductsLayout.vue";
import UpdateProductForm from "./UpdateProductForm.vue";
import ProductPricing from "./Pricing/ProductPricing.vue";

export default {
  components: {
    JetButton,
    ProductsLayout,
    UpdateProductForm,
    DeleteProductForm,
    PlantFeatures,
    ProductPricing,
  },
  data() {
    return {
      editingPricing: false,
    };
  },
  computed: {
    product() {
      return this.$page.props.product;
    },
    category() {
      return this.$page.props.category;
    },
  },
};
</script>
