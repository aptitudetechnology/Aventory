<template>
  <products-layout>
    <update-product-form :product="product" />
    <delete-product-form :product="product" class="mt-6" />
  </products-layout>
</template>
<script>
import DeleteProductForm from "./DeleteProductForm.vue";
import ProductsLayout from "./ProductsLayout.vue";
import UpdateProductForm from "./UpdateProductForm.vue";
export default {
  components: {
    ProductsLayout,
    UpdateProductForm,
    DeleteProductForm,
  },
  computed: {
    product() {
      return this.$page.props.product;
    },
  },
};
</script>
