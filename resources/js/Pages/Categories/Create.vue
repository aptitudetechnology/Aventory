<template>
  <categories-layout>
    <create-category-form></create-category-form>
  </categories-layout>
</template>

<script>
import CategoriesLayout from "./CategoriesLayout.vue";
import CreateCategoryForm from "./CreateCategoryForm.vue";
export default {
  components: {
    CategoriesLayout,
    CreateCategoryForm,
  },
};
</script>
