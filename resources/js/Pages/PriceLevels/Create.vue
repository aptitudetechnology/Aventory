<template>
  <price-levels-layout>
    <create-price-level-form></create-price-level-form>
  </price-levels-layout>
</template>

<script>
import PriceLevelsLayout from "./PriceLevelsLayout.vue";
import createPriceLevelForm from "./CreatePriceLevelForm.vue";
export default {
  components: {
    PriceLevelsLayout,
    createPriceLevelForm,
  },
};
</script>
