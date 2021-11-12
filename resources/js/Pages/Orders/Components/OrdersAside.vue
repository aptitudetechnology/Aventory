<template>
    <page-aside :showOnMobile="route().current('orders.index')">
        <template v-slot:header>
            <jet-section-title>
                <template #title>Orders</template>
                <template v-if="ordersLength > 10" #description
                    >Search {{ ordersLength }}
                    {{ ordersLength > 1 ? "Orders" : "Order" }}</template
                >

                <template #aside
                    ><button-link :href="route('orders.create')"
                        >New Order</button-link
                    ></template
                >
            </jet-section-title>
            <search-input
                v-if="ordersLength > 10"
                v-model="search"
                @input="updateOrders"
                placeholder="Search by customer, or date."
            />
        </template>

        <div class="bg-white">
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="order in filteredOrders"
                    :key="order.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="route('orders.show', order.id)"
                        :current="route().current('orders.show', order.id)"
                    >
                        <div class="flex-1 min-w-0">
                            <div class="focus:outline-none">
                                <!-- Extend touch target to entire panel -->
                                <span
                                    class="absolute inset-0"
                                    aria-hidden="true"
                                />
                                <p class="text-sm font-medium text-gray-900">
                                    <b class="font-bold">Customer: </b
                                    >{{ order.customer.name }}
                                </p>
                                <p
                                    v-if="order.notes"
                                    class="text-sm text-gray-900 truncate"
                                >
                                    <b class="font-bold">Notes: </b
                                    >{{ order.description }}
                                </p>
                                <p class="text-sm text-gray-900 truncate">
                                    <b class="font-bold">Order Date: </b
                                    >{{ new Date(order.date).toDateString() }}
                                </p>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state
            v-if="ordersLength < 1 && route().current('orders.index')"
            heading="No Orders"
            subtitle="Get started by creating a new order."
            button-text="New Order"
            :href="route('orders.create')"
        />
    </page-aside>
</template>
<script>
import ButtonLink from "@Components/ButtonLink";
import TabContainer from "@Components/TabContainer.vue";
import TabLink from "@Components/TabLink";
import SearchInput from "@Components/SearchInput.vue";
import PageAside from "@Components/PageAside.vue";
import AsideLink from "@Components/AsideLink.vue";
import EmptyState from "@Components/EmptyState.vue";
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
export default {
    components: {
        PageAside,
        AsideLink,
        ButtonLink,
        TabContainer,
        TabLink,
        SearchInput,
        EmptyState,
        JetSectionTitle,
    },
    props: {
        orders: Array,
    },
    computed: {
        ordersLength: function () {
            return this.orders.length;
        },
    },
    data() {
        return {
            search: "",
            filteredOrders: this.orders,
        };
    },
    methods: {
        updateOrders() {
            this.filteredOrders = this.orders.filter((order) => {
                let lowerSearch = this.search.toLowerCase();
                if (
                    order.customer_name.toLowerCase().includes(lowerSearch) ||
                    order.date?.includes(lowerSearch) ||
                    order.order_number?.toLowerCase().includes(lowerSearch)
                ) {
                    return true;
                } else {
                    return false;
                }
            });
        },
    },
};
</script>
