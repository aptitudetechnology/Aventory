<template>
  <vendors-layout>
    <create-vendor-form />
  </vendors-layout>
</template>

<script>
import CreateVendorForm from "./CreateVendorForm";
import VendorsLayout from "./VendorsLayout.vue";
export default {
  components: {
    CreateVendorForm,
    VendorsLayout,
  },
};
</script>
