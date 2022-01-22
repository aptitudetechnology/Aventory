<template>
    <details-section>
        <template #title>Linked Orders </template>

        <div>
            <SmallLineItem
                as="a"
                target="_blank"
                :href="route(order.route, order.id)"
                v-for="order in orders"
                :key="order.id"
                class="flex items-center justify-between py-2"
            >
                <div class="flex items-center">
                    <span class="text-sm">
                        {{ order.name }}
                    </span>
                    <span class="text-sm ml-2">
                        {{ formatDate(order.created_at) }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm ml-2">
                        {{ formatMoney(order.total) }}
                    </span>
                </div>
            </SmallLineItem>
            <EmptyState
                v-if="!orders.length"
                heading="No orders created from this quote."
                :showIcon="false"
                align="left"
                class="p-0"
            />
        </div>
    </details-section>
</template>

<script>
import DetailsSection from "@Components/DetailsSection.vue";
import SmallLineItem from "@Components/Lists/SmallLineItem.vue";
import EmptyState from "@Components/EmptyState.vue";
import axios from "axios";
export default {
    components: {
        DetailsSection,
        SmallLineItem,
        EmptyState,
    },
    props: {
        quote: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            loading: false,
            errorMessage: null,
            orders: [],
        };
    },
    computed: {
        hasOrders() {
            return this.orders.length > 0;
        },
    },
    mounted() {
        this.getOrders();
    },
    methods: {
        getOrders() {
            this.loading = true;
            axios
                .get(route("api.quotes.orders.index", { quote: this.quote.id }))
                .then((response) => {
                    this.orders = response.data;
                })
                .catch((error) => {
                    this.errorMessage = error.message;
                    this.orders = [];
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
