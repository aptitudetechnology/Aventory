<template>
    <div class="space-y-4">
        <details-section>
            <template #title>Customer Orders</template>

            <loading-state v-if="loading" :loading="loading" />
            <empty-state
                v-else-if="!orders.length"
                heading="No Open Orders"
                :showIcon="false"
                align="left"
                class="p-0"
            />
            <div v-else class="max-h-52 overflow-y-auto">
                <a
                    v-for="order in orders"
                    key="order.id"
                    class="flex items-center justify-between py-2"
                    :href="route('orders.show', order.id)"
                    target="_blank"
                >
                    <span>{{ order.full_name }}</span>
                    <span class="link">View</span>
                </a>
            </div>
        </details-section>
        <details-section>
            <template #title>Customer Quotes</template>

            <loading-state v-if="loading" :loading="loading" />
            <empty-state
                v-else-if="!quotes.length"
                heading="No Open Quotes"
                :showIcon="false"
                align="left"
                class="p-0"
            />
            <div v-else class="max-h-52 overflow-y-auto">
                <a
                    v-for="order in quotes"
                    key="order.id"
                    class="flex items-center justify-between py-2"
                    :href="route('quotes.show', order.id)"
                    target="_blank"
                >
                    <span>{{ order.full_name }}</span>
                    <span class="link">View</span>
                </a>
            </div>
        </details-section>
    </div>
</template>

<script>
import axios from "axios";
import DetailsSection from "@/Components/DetailsSection.vue";
import EmptyState from "@/Components/EmptyState.vue";
import LoadingState from "@/Components/LoadingState.vue";
export default {
    components: {
        DetailsSection,
        EmptyState,
        LoadingState,
    },
    props: {
        customer: {
            type: Object,
            required: false,
        },
    },
    data() {
        return {
            loading: false,
            orders: [],
            quotes: [],
        };
    },
    watch: {
        customer() {
            this.getOrders();
        },
    },
    mounted() {
        this.getOrders();
    },
    methods: {
        getOrders() {
            this.loading = true;
            axios
                .get(route("api.sales.index", { customer: this.customer?.id }))
                .then((response) => {
                    this.orders = response.data.orders;
                    this.quotes = response.data.quotes;
                })
                .catch((error) => {
                    console.error(error.message);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        showOrder(order) {
            this.showPopup(route(order.route, order.id));
        },
    },
};
</script>
