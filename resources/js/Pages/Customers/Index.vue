<template>
  <customers-layout> </customers-layout>
</template>

<script>
import CustomersLayout from "./CustomersLayout.vue";
import EmptyState from "@/Components/EmptyState";
import ButtonLink from "@/Components/ButtonLink";
export default {
  components: {
    CustomersLayout,
    ButtonLink,
  },
};
</script>
