<template>
  <price-levels-layout>
    <update-price-level-form :priceLevel="priceLevel" />
    <delete-price-level-form :priceLevel="priceLevel" class="py-6" />
  </price-levels-layout>
</template>

<script>
import PriceLevelsLayout from "./PriceLevelsLayout.vue";
import UpdatePriceLevelForm from "./UpdatePriceLevelForm.vue";
import DeletePriceLevelForm from "./DeletePriceLevelForm.vue";
export default {
  components: {
    PriceLevelsLayout,
    UpdatePriceLevelForm,
    DeletePriceLevelForm,
  },
  props: {
    priceLevel: Object,
  },
};
</script>
