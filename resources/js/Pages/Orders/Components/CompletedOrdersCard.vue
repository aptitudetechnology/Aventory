<script setup>
import DetailsSection from "@/Components/DetailsSection.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";

import { onMounted, reactive, computed } from "vue";

const recentOrders = reactive({
    orders: [],
    total: "",
    count: 0,
    loading: true,
});

const headingText = computed(() => {
    return `${recentOrders.total} in sales, past 30 days`;
});

const numberOrdersText = computed(() => {
    return recentOrders.count > 1 || recentOrders.count == 0
        ? `${recentOrders.count} orders`
        : `${recentOrders.count} order`;
});

const totalText = computed(() => {
    return `There have been ${recentOrders.total} in sales the past 30 days from ${numberOrdersText.value}`;
});

onMounted(() => {
    axios
        .get(route("api.orders.index"))
        .then((response) => {
            recentOrders.orders = response.data.orders;
            recentOrders.total = response.data.total_in_dollars;
            recentOrders.count = response.data.count;
            recentOrders.loading = false;
        })
        .catch((error) => {
            console.log(error);
        });
});
</script>

<template>
    <details-section>
        <template #title>{{ headingText }}</template>
        <div class="col-span-6">
            <p class="text-lg font-bold mb-2">
                {{ numberOrdersText }}, {{ recentOrders.total }} in sales.
            </p>
            <p>{{ totalText }}</p>
        </div>

        <template #actions>
            <button-link :href="route('orders.index')">View Orders</button-link>
        </template>
    </details-section>
</template>
