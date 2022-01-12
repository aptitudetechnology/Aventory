<template>
    <quotes-layout>
        <div class="flex justify-between items-center w-full pb-9 px-2 lg:px-4">
            <heading-one>Quotes</heading-one>
            <button-link :href="route('quotes.create')">New Quote</button-link>
        </div>
        <div class="grid gap-6 lg:gap-8">
            <div class="grid gap-4 lg:gap-6 md:grid-cols-3 text-gray-900">
                <completed-orders-card
                    :thirtyDaysCompletedOrders="23"
                    :thirtyDaysCompletedSales="23000"
                />

                <details-section>
                    <template #title>Pending Orders</template>
                    <div class="col-span-6">
                        <p class="text-lg mb-2">23 Pending Orders</p>
                        <p>$25,000 in pending sales</p>
                    </div>
                </details-section>

                <active-quotes-card />
            </div>
            <view-orders
                :are-quotes="true"
                :orders="quotes"
                :filters="filters"
            />
        </div>
    </quotes-layout>
</template>

<script>
import {
    ExternalLinkIcon,
    ArrowUpIcon,
    ArrowDownIcon,
} from "@heroicons/vue/outline";
import QuotesLayout from "./QuotesLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink";
import DetailsSection from "@/Components/DetailsSection";
import HeadingOne from "@Components/Headings/HeadingOne.vue";
import CompletedOrdersCard from "@/Pages/Orders/Components/CompletedOrdersCard.vue";
import ActiveQuotesCard from "@/Pages/Quotes/Components/ActiveQuotesCard.vue";
import ViewOrders from "@/Pages/Orders/Components/OrdersView.vue";
export default {
    components: {
        ExternalLinkIcon,
        ArrowDownIcon,
        ArrowUpIcon,
        QuotesLayout,
        ButtonLink,
        DetailsSection,
        HeadingOne,
        CompletedOrdersCard,
        ActiveQuotesCard,
        ViewOrders,
    },
    props: {
        quotes: {
            type: Object,
        },
        filters: {
            type: Object,
        },
    },
};
</script>
