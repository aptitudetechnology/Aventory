<script setup>
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ReportsLayout from "./ReportsLayout.vue";
import ActiveQuotesCard from "../Quotes/Components/ActiveQuotesCard.vue";
import OrdersView from "../Orders/Components/OrdersView.vue";
import CompletedOrdersCard from "../Orders/Components/CompletedOrdersCard.vue";
</script>

<template>
    <ReportsLayout>
        <div class="flex justify-between items-center w-full pb-9 px-2 lg:px-4">
            <heading-one>Reports</heading-one>
        </div>

        <div class="grid gap-6 lg:gap-8">
            <div class="grid gap-4 lg:gap-6 md:grid-cols-3 text-gray-900">
                <ActiveQuotesCard />

                <CompletedOrdersCard />
            </div>
        </div>
    </ReportsLayout>
</template>
