<script setup>
import DetailsSection from "@/Components/DetailsSection.vue";
import { ExternalLinkIcon } from "@heroicons/vue/outline";
import ButtonLink from "@/Components/Links/ButtonLink.vue";

import { onMounted, reactive, computed } from "vue";
import route from "vendor/tightenco/ziggy/src/js";

const completedOrders = reactive({
    orders: [],
    loading: true,
});

const numCompletedOrders = computed(() => completedOrders.orders.length);
const totalOfCompletedOrders = computed(() => {
    return completedOrders.orders.reduce((acc, order) => {
        return acc + order.grand_total;
    }, 0);
});

onMounted(() => {
    axios
        .get(route("api.orders.completed"))
        .then((response) => {
            completedOrders.orders = response.data;
            completedOrders.loading = false;
        })
        .catch((error) => {
            console.log(error);
        });
});
</script>

<template>
    <details-section>
        <template #title>Orders, 30 Days</template>
        <div class="col-span-6">
            <p class="text-lg mb-2">{{ thirtyDaysCompletedOrders }} Orders</p>
            <p>${{ thirtyDaysCompletedSales }} in sales</p>
        </div>

        <template #actions>
            <button-link :href="route('orders.index')">View Orders</button-link>
        </template>
    </details-section>
</template>
