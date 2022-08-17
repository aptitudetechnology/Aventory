<script setup>
import PurchasesLayout from "./PurchasesLayout.vue";
import PurchasesView from "./Components/PurchasesView.vue";

import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
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
        <div class="flex justify-between items-center w-full pb-9 px-2 lg:px-4">
            <HeadingOne>Purchases</HeadingOne>
            <ButtonLink :href="route('purchases.create')"
                >New Purchase</ButtonLink
            >
        </div>
        <PurchasesView
            :purchases="purchases"
            :filters="filters"
        ></PurchasesView>
    </PurchasesLayout>
</template>
