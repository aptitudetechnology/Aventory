<template>
    <details-section>
        <template #title><slot name="title">All Inventory</slot></template>
        <template #aside>
            <search-input v-model="search"></search-input
        ></template>
        <div class="col-span-6 overflow-auto">
            <table-table class="text-left">
                <table-head>
                    <table-h class="sticky left-0 bg-white">
                        <div>
                            <jet-label class="sr-only" for="select-all"
                                >Select all</jet-label
                            ><jet-checkbox
                                id="select-all"
                                :checked="allSelected"
                                @change="toggleAllSelected"
                            /></div
                    ></table-h>
                    <table-h>Inventory ID</table-h>
                    <table-h>Quantity</table-h>
                    <table-h>Date Added</table-h>
                    <table-h>Last Inventoried</table-h>
                    <table-h>Product Name</table-h>
                    <table-h>Size</table-h>
                    <table-h>Nursery</table-h>
                    <table-h>Block</table-h>
                    <table-h>Place</table-h>
                    <table-h></table-h>
                </table-head>
                <tbody>
                    <InventoryLineItem
                        v-for="item in inventory.data"
                        :key="item.id"
                        :item="item"
                        :itemSelected="isItemSelected(item)"
                        @selected="toggleSelected(item)"
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
import {
    ExternalLinkIcon,
    ArrowUpIcon,
    ArrowDownIcon,
} from "@heroicons/vue/outline";
import DetailsSection from "@/Components/DetailsSection";
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
        ExternalLinkIcon,
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
            allSelected: false,
            selected: [],
            search: this.filters.search || "",
            orderBy: this.filters.orderBy || "",
            orderByDirection: this.filters.orderByDirection ?? "desc",
        };
    },
    computed: {
        selectedItems() {
            return this.inventory.data.filter((item) =>
                this.selected.includes(item.id)
            );
        },
    },
    watch: {
        selected: {
            handler() {
                this.allSelected =
                    this.selected.length === this.inventory.data.length;
            },
            deep: true,
        },
        search: _debounce(function (value) {
            this.updateSearch();
        }, 500),
    },
    methods: {
        toggleAllSelected() {
            this.allSelected = !this.allSelected;
            this.selected = this.allSelected
                ? this.inventory.data.map((item) => item.id)
                : [];
        },
        toggleSelected(currentItem) {
            if (this.selected.includes(currentItem.id)) {
                this.selected = this.selected.filter(
                    (item) => item !== currentItem.id
                );
            } else {
                this.selected.push(currentItem.id);
            }
        },
        isItemSelected(currentItem) {
            return this.selected.includes(currentItem.id);
        },
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
        showItem(item) {
            this.$inertia.get(route("inventory.show", item));
        },
    },
};
</script>
