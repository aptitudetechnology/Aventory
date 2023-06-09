<template>
    <details-section>
        <template #title><slot name="title">Inventory</slot></template>
        <template #aside>
            <search-input v-model="search"></search-input
        ></template>
        <div class="flex pb-4 space-x-4">
            <button-link
                v-if="filters.includePrinted"
                :href="route('reprint-queue.index')"
                class="btn btn-sm"
            >
                Hide Printed</button-link
            >
            <button-link
                v-else
                :href="route('reprint-queue.index', { includePrinted: true })"
                class="btn btn-sm"
            >
                Show Printed</button-link
            >
            <ReprintTagsButton
                :disabled="!selected.length"
                :inventory="selected"
            />
        </div>
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
                    <table-h>Qty to Print</table-h>
                    <table-h>Date Added</table-h>
                    <table-h>Product Name</table-h>
                    <table-h>Size</table-h>

                    <table-h>Nursery Location</table-h>
                    <table-h>Block</table-h>
                </table-head>
                <tbody>
                    <QueueItem
                        v-for="item in inventory.data"
                        :key="`${item.id}-${item.pivot.created_at}`"
                        :item="item"
                        :itemSelected="isItemSelected(item)"
                        @selected="toggleSelected(item)"
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
import { ArrowUpIcon, ArrowDownIcon } from "@heroicons/vue/24/outline";
import DetailsSection from "@/Components/DetailsSection.vue";
import TableTable from "@/Components/Tables/TableTable.vue";
import TableHead from "@/Components/Tables/TableHead.vue";
import TableH from "@/Components/Tables/TableH.vue";
import ReprintTagsButton from "@/Pages/ReprintQueue/Components/ReprintTagsButton.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchInput from "@/Components/Forms/SearchInput.vue";
import _debounce from "lodash/debounce";
import QueueItem from "./QueueItem.vue";

import ButtonLink from "@/Components/Links/ButtonLink.vue";
export default {
    components: {
        ArrowDownIcon,
        ArrowUpIcon,
        DetailsSection,
        TableTable,
        TableHead,
        TableH,
        ReprintTagsButton,
        SearchInput,
        Pagination,
        QueueItem,
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
        itemsToPrint() {
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
        }, 300),
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
                this.route("reprint-queue.index"),
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
