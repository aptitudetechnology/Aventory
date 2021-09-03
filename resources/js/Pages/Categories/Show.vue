<template>
  <categories-layout>
    <div class="space-y-6">
      <update-category-form :category="category" />
      <ProductPricing :category="category" />
      <delete-category-form :category="category" />
    </div>
  </categories-layout>
</template>

<script>
import CategoriesLayout from "./CategoriesLayout.vue";
import UpdateCategoryForm from "./UpdateCategoryForm.vue";
import DeleteCategoryForm from "./DeleteCategoryForm.vue";
import ProductPricing from "@/Pages/Pricing/ProductPricing.vue";
export default {
  components: {
    CategoriesLayout,
    UpdateCategoryForm,
    DeleteCategoryForm,
    ProductPricing,
  },
  props: {
    category: Object,
  },
};
</script>
