<template>
  <products-layout>
    <create-product-form />
  </products-layout>
</template>
<script>
import ProductsLayout from "./ProductsLayout.vue";
import CreateProductForm from "./CreateProductForm.vue";
export default {
  components: {
    ProductsLayout,
    CreateProductForm,
  },
};
</script>
