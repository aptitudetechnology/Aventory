<script setup>
import PurchasesLayout from "./PurchasesLayout.vue";
import PurchasesView from "./Components/PurchasesView.vue";

defineProps({
    purchases: {
        type: Object,
    },
    filters: {
        type: Object,
    },
});
</script>

<template>
    <PurchasesLayout>
        <PurchasesView
            :purchases="purchases"
            :filters="filters"
        ></PurchasesView>
    </PurchasesLayout>
</template>
