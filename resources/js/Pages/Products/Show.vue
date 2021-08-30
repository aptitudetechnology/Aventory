<template>
  <products-layout>
    <div class="space-y-6">
      <update-product-form :product="product" />
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
export default {
  components: {
    ProductsLayout,
    UpdateProductForm,
    DeleteProductForm,
    PlantFeatures,
  },
  computed: {
    product() {
      return this.$page.props.product;
    },
  },
};
</script>
