<template>
    <details-section>
        <template #title><slot name="title">Recent Orders</slot></template>
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
                            Order #
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
                    <tr
                        v-for="order in orders.data"
                        :key="order.id"
                        tabindex="0"
                        class="
                            px-2
                            rounded-md
                            hover:bg-gray-100
                            focus:bg-gray-100
                            transition
                            cursor-pointer
                        "
                        @click="$inertia.get(route('orders.show', order))"
                    >
                        <table-d>{{ order.id }}</table-d>
                        <table-d>{{ formatDate(order.date) }}</table-d>
                        <table-d>{{ order.customer.name }}</table-d>
                        <table-d>{{ order.deliveryStatus?.name }}</table-d>
                        <table-d>{{ order.grand_total }}</table-d>
                    </tr>
                </tbody>
            </table-table>
            <pagination :items="orders" />
        </div>
    </details-section>
</template>

<script>
import {
    ExternalLinkIcon,
    ArrowUpIcon,
    ArrowDownIcon,
} from "@heroicons/vue/outline";
import DetailsSection from "@/Components/DetailsSection";
import TableTable from "@/Components/Tables/TableTable.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableH from "@/Components/Tables/TableH.vue";
import TableD from "@/Components/Tables/TableD.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchInput from "@/Components/Forms/SearchInput.vue";
import _debounce from "lodash/debounce";
import moment from "moment";
export default {
    components: {
        ExternalLinkIcon,
        ArrowDownIcon,
        ArrowUpIcon,

        DetailsSection,

        TableTable,
        TableHead,
        TableH,
        TableD,
        SearchInput,
        Pagination,
    },
    props: {
        orders: {
            type: Object,
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
        },
    },
};
</script>
