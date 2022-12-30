<template>
    <details-section>
        <template #title><slot name="title">All Inventory</slot></template>
        <div class="col-span-6 overflow-auto">
            <table-table class="text-left">
                <table-head>
                    <table-h>Inventory ID</table-h>
                    <table-h>Quantity</table-h>
                    <table-h>Product Name</table-h>
                    <table-h>Size</table-h>
                    <table-h>Nursery</table-h>
                    <table-h>Block</table-h>
                    <table-h>Place</table-h>
                </table-head>
                <tbody>
                    <InventoryLineItem
                        @click="showInventory(item)"
                        v-for="item in inventory.data"
                        :key="item.id"
                        :item="item"
                    ></InventoryLineItem>
                </tbody>
            </table-table>
            <div v-if="inventory.data?.length < 1" class="p-4">
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
import Pagination from "@/Components/Pagination.vue";
import SearchInput from "@/Components/Forms/SearchInput.vue";
import _debounce from "lodash/debounce";
import InventoryLineItem from "./InventoryLineItem.vue";

import ButtonLink from "@/Components/Links/ButtonLink.vue";
export default {
    components: {
        ArrowDownIcon,
        ArrowUpIcon,
        DetailsSection,
        TableTable,
        TableHead,
        TableH,
        SearchInput,
        Pagination,
        InventoryLineItem,
        ButtonLink,
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
            search: this.filters.search || "",
            orderBy: this.filters.orderBy || "",
            orderByDirection: this.filters.orderByDirection ?? "desc",
        };
    },
    watch: {
        search: _debounce(function (value) {
            this.updateSearch();
        }, 500),
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
                    includePrinted: this.filters.includePrinted,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        },
        showInventory(item) {
            this.$inertia.get(route("inventory.show", item));
        },
    },
};
</script>
