<template>
    <vendors-layout>
        <create-vendor-form />
    </vendors-layout>
</template>

<script>
import CreateVendorForm from "./CreateVendorForm.vue";
import VendorsLayout from "./VendorsLayout.vue";
export default {
    components: {
        CreateVendorForm,
        VendorsLayout,
    },
};
</script>
