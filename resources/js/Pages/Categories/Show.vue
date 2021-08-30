<template>
  <categories-layout>
    <update-category-form :category="category" />
    <delete-category-form :category="category" class="py-6" />
  </categories-layout>
</template>

<script>
import CategoriesLayout from "./CategoriesLayout.vue";
import UpdateCategoryForm from "./UpdateCategoryForm.vue";
import DeleteCategoryForm from "./DeleteCategoryForm.vue";
export default {
  components: {
    CategoriesLayout,
    UpdateCategoryForm,
    DeleteCategoryForm,
  },
  props: {
    category: Object,
  },
};
</script>
