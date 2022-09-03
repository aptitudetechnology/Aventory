<script setup>
import ContainerCards from "@/Components/Structure/ContainerCards.vue";
import ActiveQuotesCard from "@/Pages/Quotes/Components/ActiveQuotesCard.vue";
import CompletedOrdersCard from "@/Pages/Orders/Components/CompletedOrdersCard.vue";
</script>

<template>
    <ContainerCards>
        <ActiveQuotesCard />
        <CompletedOrdersCard />
    </ContainerCards>
</template>
