<template>
    <details-section>
        <template #title>Completed Orders, 30 Days</template>
        <div class="col-span-6">
            <p class="text-lg mb-2">
                {{ thirtyDaysCompletedOrders }} Completed Orders
            </p>
            <p>${{ thirtyDaysCompletedSales }} in completed sales</p>
        </div>

        <template #actions>
            <button-link :href="route('orders.index')">View Orders</button-link>
        </template>
    </details-section>
</template>

<script>
import DetailsSection from "@/Components/DetailsSection.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
export default {
    components: {
        DetailsSection,
        ButtonLink,
    },
    props: {
        /**
         * The number of completed orders.
         */
        thirtyDaysCompletedOrders: {
            type: Number,
            required: true,
        },
        /**
         * The total amount in dollars of completed sales.
         */
        thirtyDaysCompletedSales: {
            type: Number,
            required: true,
        },
    },
};
</script>
