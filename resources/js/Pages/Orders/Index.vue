<template>
    <orders-layout>
        <div class="flex justify-between items-center w-full pb-9 px-2">
            <heading-one>Orders</heading-one>
            <button-link :href="route('orders.create')">New Order</button-link>
        </div>
        <div class="grid gap-6 lg:gap-8">
            <div class="grid gap-4 lg:gap-6 md:grid-cols-3">
                <completed-orders-card
                    :thirtyDaysCompletedOrders="23"
                    :thirtyDaysCompletedSales="23000"
                />

                <details-section>
                    <template #title>Pending Orders</template>
                    <div class="col-span-6">
                        <p>23 Pending Orders</p>
                        <p>$25,000 in pending sales</p>
                    </div>
                </details-section>

                <details-section>
                    <template #title>Quotes</template>
                    <template #aside
                        ><ExternalLinkIcon class="w-6 h-6 stroke-current"
                    /></template>
                    <div class="col-span-6">
                        <p>130 Active quotes</p>
                        <p>$130,000 in active quotes</p>
                    </div>
                </details-section>
            </div>
            <details-section>
                <template #title>Recent Orders</template>
                <div class="col-span-6">
                    <table-table class="text-left">
                        <table-head>
                            <table-h>Order #</table-h>
                            <table-h>Customer</table-h>
                            <table-h>Date</table-h>
                            <table-h>Status</table-h>
                            <table-h>Total</table-h>
                        </table-head>
                        <tbody>
                            <tr v-for="order in orders.data" :key="order.id">
                                <table-d>{{ order.id }}</table-d>
                                <table-d>{{ order.customer.name }}</table-d>
                                <table-d>{{ order.date }}</table-d>
                                <table-d>{{ order.status }}</table-d>
                                <table-d>{{ order.grand_total }}</table-d>
                            </tr>
                        </tbody>
                    </table-table>
                    <pagination :items="orders" />
                </div>
            </details-section>
        </div>
    </orders-layout>
</template>

<script>
import { ExternalLinkIcon } from "@heroicons/vue/outline";
import OrdersLayout from "./OrdersLayout.vue";
import ButtonLink from "@/Components/ButtonLink";
import DetailsSection from "@/Components/DetailsSection";
import HeadingOne from "@Components/HeadingOne.vue";
import CompletedOrdersCard from "./Components/CompletedOrdersCard.vue";
import TableTable from "@/Components/Tables/TableTable.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableH from "@/Components/Tables/TableH.vue";
import TableD from "@/Components/Tables/TableD.vue";
import Pagination from "@/Components/Pagination.vue";
export default {
    components: {
        ExternalLinkIcon,
        OrdersLayout,
        ButtonLink,
        DetailsSection,
        HeadingOne,
        CompletedOrdersCard,
        TableTable,
        TableHead,
        TableH,
        TableD,
        Pagination,
    },
    props: {
        orders: {
            type: Object,
        },
    },
};
</script>
