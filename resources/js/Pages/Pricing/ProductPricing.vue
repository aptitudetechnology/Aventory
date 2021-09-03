<template>
  <div class="my-5 md:mt-0 space-y-6">
    <div
      v-if="product"
      class="py-5 bg-white shadow sm:rounded-lg overflow-hidden"
    >
      <div class="px-4 sm:px-6">
        <jet-section-title :showBorder="false">
          <template #title>Custom Product Sizes and Pricing</template>
          <template v-if="product.prices.length" #aside
            ><CreatePrice :product="product"
          /></template>
        </jet-section-title>
      </div>
      <PriceTable :prices="product.prices" />
      <CreatePrice
        class="px-4 sm:px-6"
        v-if="!product.prices.length"
        :product="product"
      />
    </div>
    <div
      v-if="category"
      class="py-5 bg-white shadow sm:rounded-lg overflow-hidden"
    >
      <div class="px-4 sm:px-6">
        <jet-section-title :showBorder="false">
          <template #title>Category Sizes and Pricing</template>
          <template v-if="category.prices.length" #aside
            ><CreatePrice :category="category"
          /></template>
        </jet-section-title>
      </div>
      <PriceTable :prices="category.prices" />
      <CreatePrice
        class="px-4 sm:px-6"
        v-if="!category.prices.length"
        :category="category"
      />
    </div>
  </div>
</template>
<script>
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import PriceTable from "./PriceTable.vue";
import CreatePrice from "./CreatePrice.vue";
export default {
  props: { product: Object, category: Object },
  components: {
    JetSectionTitle,
    PriceTable,
    CreatePrice,
  },
  data() {
    return {
      creatingCustomer: true,
    };
  },
};
</script>
