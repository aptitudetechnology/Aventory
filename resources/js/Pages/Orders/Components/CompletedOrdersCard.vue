<template>
    <details-section>
        <template #title>Completed Orders, 30 Days</template>
        <div class="col-span-6">
            <p>{{ thirtyDaysCompletedOrders }} Completed Orders</p>
            <p>${{ thirtyDaysCompletedSales }} in completed sales</p>
        </div>
    </details-section>
</template>

<script>
import DetailsSection from "@Components/DetailsSection.vue";
export default {
    components: {
        DetailsSection,
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
