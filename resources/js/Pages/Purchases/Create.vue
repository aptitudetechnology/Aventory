<template>
    <purchases-layout>
        <create-purchase-form />
    </purchases-layout>
</template>

<script>
import PurchasesLayout from "./PurchasesLayout.vue";

import CreatePurchaseForm from "./Components/CreatePurchaseForm.vue";
export default {
    components: {
        PurchasesLayout,
        CreatePurchaseForm,
    },
};
</script>
