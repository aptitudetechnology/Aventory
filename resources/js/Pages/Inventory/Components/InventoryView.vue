<template>
    <details-section>
        <template #title><slot name="title">Inventory</slot></template>
        <template #aside
            ><search-input v-model="search"></search-input
        ></template>
        <div class="col-span-6 overflow-auto">
            <table-table class="text-left">
                <table-head>
                    <table-h>Inventory ID</table-h>
                    <table-h>Date Added</table-h>
                    <table-h>Product Name</table-h>
                    <table-h>Size</table-h>
                    <table-h>Block Location</table-h>
                </table-head>
                <tbody>
                    <tr
                        v-for="item in inventory.data"
                        :key="item.id"
                        tabindex="0"
                        class="px-2 border-b border-gray-50 last:border-transparent hover:border-black focus:border-black transition cursor-pointer"
                        @click="showItem(item)"
                    >
                        <table-d>{{ item.id }}</table-d>
                        <table-d>{{ formatDate(item.created_at) }}</table-d>
                        <table-d>{{ item.product_name }}</table-d>
                        <table-d>{{ item.size_name }}</table-d>
                        <table-d>{{ item.block.name }}</table-d>
                    </tr>
                </tbody>
            </table-table>
            <div v-if="inventory?.data?.length < 1" class="p-4">
                <div class="text-gray-500">No Inventory found.</div>
            </div>
            <pagination v-if="inventory.data" :items="inventory" />
        </div>
    </details-section>
</template>

<script>
import { ArrowUpIcon, ArrowDownIcon } from "@heroicons/vue/20/solid";
import DetailsSection from "@/Components/DetailsSection.vue";
import TableTable from "@/Components/Tables/TableTable.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableH from "@/Components/Tables/TableH.vue";
import TableD from "@/Components/Tables/TableD.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchInput from "@/Components/Forms/SearchInput.vue";
import _debounce from "lodash/debounce";
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
        inventory: {
            type: Object,
        },
        filters: {
            type: Object,
        },
    },
    data() {
        return {
            search: this.filters?.search || "",
            orderBy: this.filters?.orderBy || "",
            orderByDirection: this.filters?.orderByDirection || "",
        };
    },
    watch: {
        search: _debounce(function (value) {
            this.updateSearch();
        }, 300),
    },
    methods: {
        updateItemBy(value) {
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
                this.route("inventory.index"),
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
        showItem(item) {
            this.$inertia.get(route("inventory.show", item));
        },
    },
};
</script>
