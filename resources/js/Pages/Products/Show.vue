<template>
  <products-layout>
    <update-product-form :product="product" />
  </products-layout>
</template>
<script>
import ProductsLayout from "./ProductsLayout.vue";
import UpdateProductForm from "./UpdateProductForm.vue";
export default {
  components: {
    ProductsLayout,
    UpdateProductForm,
  },
  computed: {
    product() {
      return this.$page.props.product;
    },
  },
};
</script>
