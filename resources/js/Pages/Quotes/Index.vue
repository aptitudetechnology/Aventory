<script setup>
import QuotesLayout from "./QuotesLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ViewOrders from "@/Pages/Orders/Components/OrdersView.vue";
import BirdsEyeReports from "../Reports/Components/BirdsEyeReports.vue";
import TabContainer from "@/Components/TabContainer.vue";
import TabLink from "@/Components/Links/TabLink.vue";
import ContainerFlexHorizontal from "@/Components/Structure/ContainerFlexHorizontal.vue";
import ContainerSpaceBetween from "@/Components/Structure/ContainerSpaceBetween.vue";
import ContainerPaddingX from "@/Components/Structure/ContainerPaddingX.vue";
import NewOrderNewQuote from "@/Components/Navigation/NewOrderNewQuote.vue";

defineProps({
    quotes: {
        type: Object,
    },
    filters: {
        type: Object,
    },
});
</script>

<template>
    <quotes-layout>
        <container-space-between>
            <container-padding-x>
                <container-flex-horizontal>
                    <heading-one>Orders & Quotes</heading-one>
                    <new-order-new-quote />
                </container-flex-horizontal>
            </container-padding-x>
            <birds-eye-reports />
            <view-orders
                :are-quotes="true"
                :orders="quotes"
                :filters="filters"
            />
        </container-space-between>
    </quotes-layout>
</template>
