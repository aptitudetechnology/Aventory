<template>
  <table v-if="prices.length" class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <TableH> Size </TableH>
      <TableH> Unit Price </TableH>
      <TableH> Show in availability </TableH>
      <TableH> </TableH>
    </thead>
    <tbody class="divide-y divide-gray-200 mt-4">
      <UpdatePrice v-for="price in prices" :key="price.id" :price="price" />
    </tbody>
  </table>
</template>

<script>
import UpdatePrice from "./UpdatePrice.vue";
import TableH from "@Components/TableH";
export default {
  components: {
    UpdatePrice,
    TableH,
  },
  props: {
    prices: Array,
  },
};
</script>
