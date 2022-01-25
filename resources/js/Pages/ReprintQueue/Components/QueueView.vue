<template>
    <details-section>
        <template #title><slot name="title">Inventory</slot></template>
        <template #aside
            ><search-input v-model="search"></search-input
        ></template>
        <div class="flex pb-4 space-x-4" v-if="selected.length">
            <PrintPurchaseItemsInventory :purchase_items="selected" />
        </div>
        <div class="col-span-6 overflow-auto">
            <table-table class="text-left">
                <table-head>
                    <table-h
                        ><jet-checkbox>
                            <jet-label class="sr-only" for="select-all"
                                >Select all</jet-label
                            ><jet-checkbox
                                id="select-all"
                                :checked="allSelected"
                                v-model="allSelected"
                                @checked="toggleAllSelected" /></jet-checkbox
                    ></table-h>
                    <table-h>Inventory ID</table-h>
                    <table-h>Date Added</table-h>
                    <table-h>Product Name</table-h>
                    <table-h>Size</table-h>
                    <table-h>Block Location</table-h>
                </table-head>
                <tbody>
                    <QueueItem
                        v-for="item in inventory.data"
                        :key="item.id"
                        :item="item"
                    ></QueueItem>
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
import PrintPurchaseItemsInventory from "@/Pages/Purchases/Components/PrintPurchaseItemsInventory.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchInput from "@/Components/Forms/SearchInput.vue";
import _debounce from "lodash/debounce";
import QueueItem from "./QueueItem.vue";
export default {
    components: {
        ExternalLinkIcon,
        ArrowDownIcon,
        ArrowUpIcon,
        DetailsSection,
        TableTable,
        TableHead,
        TableH,
        PrintPurchaseItemsInventory,
        SearchInput,
        Pagination,
        QueueItem,
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
            search: this.filters?.search || "",
            orderBy: this.filters?.orderBy || "",
            orderByDirection: this.filters?.orderByDirection || "",
        };
    },
    computed: {
        itemsToPrint() {
            return this.inventory.data.filter((item) =>
                this.selected.includes(item.id)
            );
        },
    },
    watch: {
        selected() {
            //watches selected to uncheck the select all checkbox if selected is empty
            let selectedLength = this.selected.length;

            if (selectedLength === 0) {
                this.allSelected = false;
            }
        },
        search: _debounce(function (value) {
            this.updateSearch();
        }, 300),
    },
    methods: {
        toggleSelected(item) {
            if (this.selected.includes(item.id)) {
                this.selected = this.selected.filter((id) => id != item.id);
            } else {
                this.selected.push(item.id);
            }
        },
        isItemSelected(item) {
            return this.selected.includes(item.id);
        },
        toggleAllSelected() {
            if (this.allSelected) {
                this.selected = this.purchaseItems.map((item) => item.id);
            } else {
                this.selected = [];
            }
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
                this.route("reprint-queue.index"),
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
