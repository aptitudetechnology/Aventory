<script setup>
import QuotesLayout from "./QuotesLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ViewOrders from "@/Pages/Orders/Components/OrdersView.vue";
import BirdsEyeReports from "../Reports/Components/BirdsEyeReports.vue";
import TabContainer from "@/Components/TabContainer.vue";
import TabLink from "@/Components/Links/TabLink.vue";

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
            <view-orders
                :are-quotes="true"
                :orders="quotes"
                :filters="filters"
            />
        </div>
    </quotes-layout>
</template>
