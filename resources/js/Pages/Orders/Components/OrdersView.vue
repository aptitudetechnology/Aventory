<script>
import { ArrowUpIcon, ArrowDownIcon } from "@heroicons/vue/20/solid";
import DetailsSection from "@/Components/DetailsSection.vue";
import TableTable from "@/Components/Tables/TableTable.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableH from "@/Components/Tables/TableH.vue";
import TableD from "@/Components/Tables/TableD.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchInput from "@/Components/Forms/SearchInput.vue";
import TabContainer from "@/Components/TabContainer.vue";
import TabLink from "@/Components/Links/TabLink.vue";
import _debounce from "lodash/debounce";
import moment from "moment";
import TableRow from "@/Components/Tables/TableRow.vue";
export default {
    components: {
        ArrowDownIcon,
        ArrowUpIcon,
        DetailsSection,
        TableTable,
        TableHead,
        TableH,
        TableD,
        SearchInput,
        Pagination,
        TabContainer,
        TabLink,
        TableRow,
    },
    props: {
        orders: {
            type: Object,
        },
        areQuotes: {
            type: Boolean,
            default: false,
        },
        filters: {
            type: Object,
        },
    },
    data() {
        return {
            search: this.filters.search || "",
            orderBy: this.filters.orderBy || "",
            orderByDirection: this.filters.orderByDirection || "",
        };
    },
    watch: {
        search: _debounce(function (value) {
            this.updateSearch();
        }, 200),
    },
    methods: {
        formatDate: (value) => moment(value).format("MM/DD/YYYY"),
        updateOrderBy(value) {
            if (this.orderBy === value) {
                this.orderByDirection =
                    this.orderByDirection === "desc" ? "asc" : "desc";
            } else {
                this.orderBy = value;
                this.orderByDirection = "desc";
            }
            this.updateSearch();
        },
        updateSearch() {
            if (this.areQuotes) {
                this.$inertia.get(
                    this.route("quotes.index"),
                    {
                        search: this.search,
                        orderBy: this.orderBy,
                        orderByDirection: this.orderByDirection,
                    },
                    {
                        preserveState: true,
                        replace: true,
                    }
                );
            } else {
                this.$inertia.get(
                    this.route("orders.index"),
                    {
                        search: this.search,
                        orderBy: this.orderBy,
                        orderByDirection: this.orderByDirection,
                    },
                    {
                        preserveState: true,
                        replace: true,
                    }
                );
            }
        },
        showOrder(order) {
            order.is_quote
                ? this.$inertia.get(route("quotes.show", order))
                : this.$inertia.get(route("orders.show", order));
        },
    },
};
</script>

<template>
    <details-section>
        <template #title
            ><slot name="title"
                >{{ areQuotes ? "Quotes" : "Orders" }}
                {{ search ? "for " + search : "" }}</slot
            >
            <tab-container class="px-0">
                <tab-link
                    :href="route('orders.index')"
                    :current="route().current('orders.*')"
                    >Orders</tab-link
                >
                <tab-link
                    :href="route('quotes.index')"
                    :current="route().current('quotes.*')"
                    >Quotes</tab-link
                >
            </tab-container>
        </template>
        <template #aside
            ><search-input v-model="search"></search-input
        ></template>

        <div class="col-span-6 overflow-auto">
            <table-table class="text-left">
                <table-head>
                    <table-h
                        ><div
                            class="select-none cursor-pointer flex items-center"
                            :class="orderBy == 'id' ? 'text-gray-900' : ''"
                            @click="updateOrderBy('id')"
                        >
                            {{ areQuotes ? "Quote #" : "Order #" }}
                            <ArrowUpIcon
                                v-if="
                                    orderBy == 'id' && orderByDirection == 'asc'
                                "
                                class="ml-2 w-3 h-3"
                            />
                            <ArrowDownIcon v-else class="ml-2 w-3 h-3" /></div
                    ></table-h>
                    <table-h
                        ><div
                            class="select-none cursor-pointer flex items-center"
                            :class="orderBy == 'date' ? 'text-gray-900' : ''"
                            @click="updateOrderBy('date')"
                        >
                            Date
                            <ArrowUpIcon
                                v-if="
                                    orderBy == 'date' &&
                                    orderByDirection == 'asc'
                                "
                                class="ml-2 w-3 h-3"
                            />
                            <ArrowDownIcon v-else class="ml-2 w-3 h-3" /></div
                    ></table-h>
                    <table-h
                        ><div
                            class="select-none cursor-pointer flex items-center"
                            :class="
                                orderBy == 'customer' ? 'text-gray-900' : ''
                            "
                            @click="updateOrderBy('customer')"
                        >
                            Customer
                            <ArrowUpIcon
                                v-if="
                                    orderBy == 'customer' &&
                                    orderByDirection == 'asc'
                                "
                                class="ml-2 w-3 h-3"
                            />
                            <ArrowDownIcon v-else class="ml-2 w-3 h-3" />
                        </div>
                    </table-h>
                    <table-h>Status</table-h>
                    <table-h>Total</table-h>
                </table-head>
                <tbody>
                    <TableRow
                        v-for="order in orders.data"
                        :key="order.id"
                        tabindex="0"
                        @click="showOrder(order)"
                    >
                        <table-d>{{ order.id }}</table-d>
                        <table-d>{{ formatDate(order.date) }}</table-d>
                        <table-d>{{ order.customer.name }}</table-d>
                        <table-d>{{
                            order.is_quote
                                ? order.status
                                : order.deliveryStatus?.name
                        }}</table-d>
                        <table-d>{{ formatMoney(order.grand_total) }}</table-d>
                    </TableRow>
                </tbody>
            </table-table>
            <div v-if="orders.data.length < 1" class="p-4">
                <div class="text-gray-500">
                    No {{ areQuotes ? "quotes" : "orders" }} found{{
                        search ? " for " + search : ""
                    }}.
                </div>
            </div>
            <pagination :items="orders" />
        </div>
    </details-section>
</template>
