<template>
  <products-layout>
    <details-section>
      <template #header>{{ product.name }}</template>
      <div class="sm:col-span-2">
        <dt class="text-sm font-medium text-gray-500">Product name</dt>
        <dd class="mt-1 text-sm text-gray-900">
          {{ product.name }}
        </dd>
      </div>
      <div class="sm:col-span-2">
        <dt class="text-sm font-medium text-gray-500">Description</dt>
        <dd class="mt-1 text-sm text-gray-900">
          {{ product.description }}
        </dd>
      </div>
    </details-section>
    <restore-product-form
      :product="product"
      class="mt-6"
    ></restore-product-form>
  </products-layout>
</template>

<script>
import { PaperClipIcon } from "@heroicons/vue/solid";
import ProductsLayout from "./ProductsLayout.vue";
import DetailsSection from "@/Components/DetailsSection";
import RestoreProductForm from "./RestoreProductForm.vue";
export default {
  components: {
    PaperClipIcon,
    ProductsLayout,
    DetailsSection,
    RestoreProductForm,
  },
  props: { product: Object },
};
</script>
