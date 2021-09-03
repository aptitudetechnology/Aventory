<template>
  <div class="my-5 md:mt-0 space-y-6">
    <div
      v-if="product"
      class="py-5 bg-white shadow sm:rounded-lg overflow-hidden"
    >
      <div class="px-4 sm:px-6">
        <jet-section-title :showBorder="false">
          <template #title>Custom Product Pricing</template>
          <template v-if="product.prices.length" #aside
            ><create-price :product="product"
          /></template>
        </jet-section-title>
      </div>
      <table
        v-if="product.prices.length"
        class="min-w-full divide-y divide-gray-200"
      >
        <thead class="bg-gray-50">
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              uppercase
              tracking-wider
            "
          >
            Size
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              uppercase
              tracking-wider
            "
          >
            Unit Price
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              uppercase
              tracking-wider
            "
          >
            Show in availability
          </th>
        </thead>
        <tbody class="divide-y divide-gray-200 mt-4">
          <update-price
            v-for="price in product.prices"
            :key="price.id"
            :price="price"
          />
        </tbody>
      </table>
      <create-price
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
          <template #title>Category Pricing</template>
          <template v-if="category.prices.length" #aside
            ><create-price :category="category"
          /></template>
        </jet-section-title>
      </div>
      <table
        v-if="category.prices.length"
        class="min-w-full divide-y divide-gray-200"
      >
        <thead class="bg-gray-50">
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              uppercase
              tracking-wider
            "
          >
            Size
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              uppercase
              tracking-wider
            "
          >
            Unit Price
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              uppercase
              tracking-wider
            "
          >
            Show in availability
          </th>
        </thead>
        <tbody class="divide-y divide-gray-200 mt-4">
          <update-price
            v-for="price in category.prices"
            :key="price.id"
            :price="price"
          />
        </tbody>
      </table>
      <create-price
        class="px-4 sm:px-6"
        v-if="!category.prices.length"
        :category="category"
      />
    </div>
  </div>
</template>
<script>
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import UpdatePrice from "./UpdatePrice.vue";
import CreatePrice from "./CreatePrice.vue";

export default {
  props: { product: Object, category: Object },
  components: {
    JetSectionTitle,
    UpdatePrice,
    CreatePrice,
  },
  data() {
    return {
      creatingCustomer: true,
    };
  },
};
</script>
