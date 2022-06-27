<template>
    <app-layout>
        <div class="py-4">
            <div
                class="flex justify-between items-center w-full pb-9 px-4 lg:px-8"
            >
                <heading-one>Dashboard</heading-one>
                <button-link :href="route('orders.create')"
                    >New Order</button-link
                >
            </div>
            <div class="grid gap-6 lg:gap-8">
                <div class="sm:px-6 lg:px-8">
                    <div
                        class="grid gap-4 lg:gap-6 md:grid-cols-3 text-gray-900"
                    >
                        <completed-orders-card
                            :thirtyDaysCompletedOrders="0"
                            :thirtyDaysCompletedSales="0"
                        />
                        <active-quotes-card />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ButtonLink from "@/Components/Links/ButtonLink";

import CompletedOrdersCard from "@/Pages/Orders/Components/CompletedOrdersCard.vue";
import ActiveQuotesCard from "@/Pages/Quotes/Components/ActiveQuotesCard.vue";

export default {
    components: {
        AppLayout,
        HeadingOne,
        ButtonLink,
        CompletedOrdersCard,
        ActiveQuotesCard,
    },
};
</script>
