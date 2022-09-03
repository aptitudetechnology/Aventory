<script setup>
import OrdersLayout from "./OrdersLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ViewOrders from "./Components/OrdersView.vue";
import BirdsEyeReports from "../Reports/Components/BirdsEyeReports.vue";
import TabContainer from "@/Components/TabContainer.vue";
import TabLink from "@/Components/Links/TabLink.vue";

defineProps({
    orders: {
        type: Object,
    },
    filters: {
        type: Object,
    },
});
</script>

<template>
    <orders-layout>
        <div class="flex justify-between items-center w-full pb-9 px-2 lg:px-4">
            <heading-one>Orders & Quotes</heading-one>
            <div>
                <button-link
                    class="btn-secondary mr-4"
                    :href="route('quotes.create')"
                    >New Quote</button-link
                >
                <button-link :href="route('orders.create')"
                    >New Order</button-link
                >
            </div>
        </div>
        <div class="grid gap-6 lg:gap-8">
            <birds-eye-reports />
            <view-orders :orders="orders" :filters="filters" />
        </div>
    </orders-layout>
</template>
