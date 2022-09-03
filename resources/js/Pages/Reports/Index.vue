<script setup>
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ReportsLayout from "./ReportsLayout.vue";
import ActiveQuotesCard from "../Quotes/Components/ActiveQuotesCard.vue";
import OrdersView from "../Orders/Components/OrdersView.vue";
import CompletedOrdersCard from "../Orders/Components/CompletedOrdersCard.vue";
import ContainerCards from "@/Components/Structure/ContainerCards.vue";
import ContainerSpaceBetween from "../../Components/Structure/ContainerSpaceBetween.vue";
import ContainerPaddingX from "../../Components/Structure/ContainerPaddingX.vue";
</script>

<template>
    <ReportsLayout>
        <ContainerSpaceBetween>
            <ContainerPaddingX>
                <heading-one>Reports</heading-one>
            </ContainerPaddingX>
            <ContainerCards>
                <ActiveQuotesCard />
                <CompletedOrdersCard />
            </ContainerCards>
        </ContainerSpaceBetween>
    </ReportsLayout>
</template>
