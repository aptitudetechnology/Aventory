<template>
  <table v-if="prices.length" class="min-w-full divide-y divide-gray-200">
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
      <update-price v-for="price in prices" :key="price.id" :price="price" />
    </tbody>
  </table>
</template>

<script>
import UpdatePrice from "./UpdatePrice.vue";
export default {
  components: {
    UpdatePrice,
  },
  props: {
    prices: Array,
  },
};
</script>
