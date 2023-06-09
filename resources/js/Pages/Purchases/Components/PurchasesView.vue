<template>
    <details-section>
        <template #title
            ><slot name="title"
                >Recent Purchases {{ search ? "for " + search : "" }}</slot
            ></template
        >
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
                            Purchase #
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
                            :class="orderBy == 'vendor' ? 'text-gray-900' : ''"
                            @click="updateOrderBy('vendor')"
                        >
                            Customer
                            <ArrowUpIcon
                                v-if="
                                    orderBy == 'vendor' &&
                                    orderByDirection == 'asc'
                                "
                                class="ml-2 w-3 h-3"
                            />
                            <ArrowDownIcon v-else class="ml-2 w-3 h-3" />
                        </div>
                    </table-h>
                </table-head>
                <tbody>
                    <tr
                        v-for="purchase in purchases.data"
                        :key="purchase.id"
                        tabindex="0"
                        class="px-2 border-b border-gray-50 last:border-transparent hover:border-black focus:border-black transition cursor-pointer"
                        @click="showPurchase(purchase)"
                    >
                        <table-d>{{ purchase.id }}</table-d>
                        <table-d>{{ formatDate(purchase.date) }}</table-d>
                        <table-d>{{ purchase.vendor.name }}</table-d>
                    </tr>
                </tbody>
            </table-table>
            <div v-if="purchases.data.length < 1" class="p-4">
                <div class="text-gray-500">
                    No purchases found {{ search ? " for " + search : "" }}.
                </div>
            </div>
            <pagination :items="purchases" />
        </div>
    </details-section>
</template>

<script>
import { ArrowUpIcon, ArrowDownIcon } from "@heroicons/vue/24/outline";
import DetailsSection from "@/Components/DetailsSection.vue";
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
        purchases: {
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
                this.route("purchases.index"),
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
        showPurchase(purchase) {
            if (purchase) {
                this.$inertia.get(route("purchases.show", purchase));
            }
        },
    },
};
</script>
