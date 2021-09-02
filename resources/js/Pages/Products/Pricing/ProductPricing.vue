<template>
  <div class="my-5 md:mt-0">
    <div class="py-5 bg-white shadow sm:rounded-lg overflow-hidden">
      <div class="px-4 sm:px-6">
        <jet-section-title>
          <template #title>Product Pricing</template>
          <template v-if="product.base_prices.length" #aside
            ><create-product-price :product="product"
          /></template>
        </jet-section-title>
      </div>

      <div class="divide-y divide-gray-200 mt-4">
        <update-price
          v-for="price in product.base_prices"
          :key="price.id"
          :price="price"
        />
        <create-product-price
          class="px-4 sm:px-6"
          v-if="!product.base_prices.length"
          :product="product"
        />
      </div>
    </div>
  </div>
</template>
<script>
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import UpdatePrice from "./UpdatePrice.vue";
import CreateProductPrice from "./CreateProductPrice.vue";

export default {
  props: { product: Object },
  components: {
    JetSectionTitle,
    UpdatePrice,
    CreateProductPrice,
  },
  data() {
    return {
      creatingCustomer: true,
    };
  },
};
</script>
