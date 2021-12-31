<template>
    <jet-action-section>
        <template #title>Purchase Items</template>
        <template #aside>
            <create-purchase-item :purchase="purchase" />
        </template>
        <template #content>
            <div class="flex pb-4 space-x-4" v-if="selected.length">
                <AddPurchaseItemsToInventory
                    v-if="itemsNotInInventory"
                    :selectedItems="selected"
                />
                <PrintPurchaseItemsInventory
                    v-if="itemsInInventory"
                    :purchase_items="selected"
                />
            </div>
            <div>
                <div
                    class="
                        py-3
                        text-left text-xs
                        font-medium
                        text-gray-500
                        uppercase
                        tracking-wider
                        grid
                        gap-4
                        grid-cols-5
                        md:grid-cols-10
                        items-center
                        border-b border-gray-50
                    "
                >
                    <div class="col-span-2 md:col-span-4 flex items-center">
                        <jet-label class="sr-only" for="select-all"
                            >Select all</jet-label
                        ><jet-checkbox
                            id="select-all"
                            :checked="allSelected"
                            v-model="allSelected"
                            @change="toggleAllSelected"
                        />
                        <div class="ml-6">Name</div>
                    </div>

                    <div class="truncate">Size</div>

                    <div class="truncate">Confirmed</div>
                    <div class="hidden md:block truncate">Price</div>
                    <div class="hidden md:block truncate">Received</div>
                    <div class="hidden md:block truncate">Printed</div>
                    <div></div>
                </div>
                <div class="divide-gray-50 divide-y">
                    <purchase-line-item
                        @selected="toggleSelected(item)"
                        v-for="item in purchaseItems"
                        :key="item.id"
                        :item="item"
                        :itemSelected="isItemSelected(item)"
                    />
                </div>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";

import CreatePurchaseItem from "./CreatePurchaseItem.vue";
import PurchaseLineItem from "./PurchaseLineItem.vue";
import AddPurchaseItemsToInventory from "./AddPurchaseItemsToInventory.vue";
import PrintPurchaseItemsInventory from "./PrintPurchaseItemsInventory.vue";
export default {
    props: { purchase: Object, purchaseItems: Array },

    components: {
        JetActionSection,
        JetCheckbox,
        JetLabel,
        JetButton,

        CreatePurchaseItem,
        PurchaseLineItem,
        AddPurchaseItemsToInventory,
        PrintPurchaseItemsInventory,
    },

    data() {
        return {
            allSelected: false,
            selected: [],
        };
    },

    computed: {
        itemsNotInInventory() {
            return this.purchaseItems
                .filter((item) => this.selected.includes(item.id))
                .map((item) => item.in_inventory)
                .includes(false);
        },
        itemsInInventory() {
            return this.purchaseItems
                .filter((item) => this.selected.includes(item.id))
                .map((item) => item.in_inventory)
                .includes(true);
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
    },
};
</script>
