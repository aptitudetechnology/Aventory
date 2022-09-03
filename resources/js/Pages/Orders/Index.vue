<template>
    <orders-layout>
        <div class="flex justify-between items-center w-full pb-9 px-2 lg:px-4">
            <heading-one>Orders</heading-one>
            <button-link :href="route('orders.create')">New Order</button-link>
        </div>
        <div class="grid gap-6 lg:gap-8">
            <birds-eye-reports />
            <view-orders :orders="orders" :filters="filters" />
        </div>
    </orders-layout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import DetailsSection from "@/Components/DetailsSection.vue";
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import CompletedOrdersCard from "./Components/CompletedOrdersCard.vue";
import ActiveQuotesCard from "@/Pages/Quotes/Components/ActiveQuotesCard.vue";
import ViewOrders from "./Components/OrdersView.vue";
import BirdsEyeReports from "../Reports/Components/BirdsEyeReports.vue";
export default {
    components: {
        OrdersLayout,
        ButtonLink,
        DetailsSection,
        HeadingOne,
        CompletedOrdersCard,
        ActiveQuotesCard,
        ViewOrders,
        BirdsEyeReports,
    },
    props: {
        orders: {
            type: Object,
        },
        filters: {
            type: Object,
        },
    },
};
</script>
