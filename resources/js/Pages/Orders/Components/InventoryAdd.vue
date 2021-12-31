<template>
    <details-section class="w-full">
        <template #title> Inventory Detail </template>
        <div class="space-y-4 overflow-hidden max-h-screen">
            <form
                @submit.prevent="searchInventory"
                class="grid gap-2 sticky top-0 bg-white p-1 pt-0"
            >
                <jet-input-error v-if="!selectingMatch" :message="message" />
                <jet-input-error
                    v-if="!selectingMatch"
                    :message="item.errors.quantity_removed"
                />
                <div class="flex items-end space-x-2">
                    <div>
                        <jet-label for="search">Inventory ID</jet-label>
                        <search-input
                            @focus.native="$event.target.select()"
                            :placeholder="'Search by Inventory ID'"
                            required
                            v-model="item.inventory_id"
                        />
                    </div>

                    <jet-button type="submit" class="text-center">
                        Add
                    </jet-button>
                </div>
            </form>
            <InventoryMatchedList :inventory="inventory" :order="order" />
        </div>
        <confirmation-modal
            @close="creatingMatch = false"
            :show="creatingMatch"
        >
            <template #title> Add {{ inventoryItem.product.name }}?</template>
            <template #content>
                <form @keydown.enter.prevent="addInventory">
                    Do you want to add a new line item of
                    {{ inventoryItem.product.name }} in size
                    {{ inventoryItem.size.name }} to the order?
                    <div class="border-t pt-4 mt-4">
                        <jet-input-error
                            :message="item.errors.quantity_removed"
                        />
                        <div class="flex items-center justify-between mt-2">
                            <jet-label class="font-bold" for="quantity-confirm"
                                >Quantity:</jet-label
                            >
                            <jet-input
                                type="number"
                                id="quantity-confirm"
                                v-model.number="item.quantity_removed"
                                :error="
                                    item.errors.quantity_removed ? true : false
                                "
                            ></jet-input>
                        </div>
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="flex items-center justify-between">
                    <jet-secondary-button
                        type="button"
                        @click="creatingMatch = false"
                    >
                        Cancel
                    </jet-secondary-button>
                    <jet-button
                        type="submit"
                        :disabled="!creatingMatch"
                        @click="addInventory"
                    >
                        Yes, Add Item
                    </jet-button>
                </div>
            </template>
        </confirmation-modal>
        <dialog-modal @close="selectingMatch = false" :show="selectingMatch">
            <template #title>{{
                this.thereAreUnmatchedMatches
                    ? "Select order item to match"
                    : "Select order item to match and increase quantity of"
            }}</template>
            <template #description>
                <div>
                    Select the order item to match ID #{{
                        inventoryItem.id
                    }}
                    inventory item: {{ inventoryItem.product.name }} in size
                    {{ inventoryItem.size.name }} to.
                </div>
                <div class="font-bold">
                    {{
                        this.thereAreUnmatchedMatches
                            ? ""
                            : "This will increase the quantity of the order item."
                    }}
                </div>
            </template>
            <template #content>
                <form @keydown.enter.prevent="addInventory">
                    <jet-input-error class="mb-4 px-1" :message="message" />
                    <RadioListSelect
                        v-if="thereAreUnmatchedMatches"
                        v-model="match"
                        id="match"
                        :label="'Select Match'"
                        nameValue="product_name"
                        descriptionValue="size_name"
                        :options="unmatchedMatches"
                        :selectedItem="match"
                        @update="updateMatch"
                        class="mb-4"
                    />
                    <RadioListSelect
                        v-else
                        v-model="match"
                        id="match"
                        :label="'Select Match'"
                        nameValue="product_name"
                        descriptionValue="size_name"
                        :options="matchedMatches"
                        :selectedItem="match"
                        @update="updateMatch"
                        class="mb-4"
                    />
                    <div class="mt-2 grid gap-4">
                        <div>
                            <jet-input-error
                                :message="item.errors.quantity_removed"
                            />
                            <div class="flex items-center justify-between mt-2">
                                <jet-label class="font-bold" for="quantity"
                                    >Quantity:</jet-label
                                >
                                <jet-input
                                    id="quantity"
                                    type="number"
                                    :error="
                                        item.errors.quantity_removed
                                            ? true
                                            : false
                                    "
                                    v-model.number="item.quantity_removed"
                                />
                            </div>
                        </div>
                        <div>
                            <div
                                v-if="needToConfirmQuantity"
                                class="flex items-center mb-2"
                            >
                                <jet-label
                                    :class="{
                                        'text-red-500':
                                            needToConfirmQuantity &&
                                            !confirm_quantity,
                                    }"
                                    for="confirm_quantity"
                                    >Increase quantity of order item from
                                    {{ orderItemQuantity }} to
                                    {{
                                        orderItemQuantityAfterAdding
                                    }}?</jet-label
                                >
                                <jet-checkbox
                                    id="confirm_quantity"
                                    v-model="confirm_quantity"
                                />
                            </div>
                            <jet-input-error
                                :message="item.errors.confirm_quantity"
                            />
                        </div>
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="flex items-center justify-between">
                    <jet-secondary-button
                        type="button"
                        @click="selectingMatch = false"
                    >
                        Cancel
                    </jet-secondary-button>
                    <jet-secondary-button
                        type="button"
                        @click="confirmAddLineItem"
                        class="mr-auto ml-2"
                    >
                        Add New Order Line Item</jet-secondary-button
                    >
                    <jet-button
                        type="submit"
                        :disabled="!match"
                        @click="addInventory"
                    >
                        Match Item
                    </jet-button>
                </div>
            </template>
        </dialog-modal>
    </details-section>
</template>
<script>
import SearchInput from "@/Components/Forms/SearchInput.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import RadioListSelect from "@Components/Forms/RadioListSelect.vue";
import InventoryMatchedList from "./InventoryMatchedList.vue";
import axios from "axios";
export default {
    components: {
        SearchInput,
        ConfirmationModal,
        DialogModal,
        RadioListSelect,
        InventoryMatchedList,
    },
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            item: this.$inertia.form({
                inventory_id: null,
                order_item_id: null,
                quantity_removed: 1,
            }),
            inventory: [],
            confirm_quantity: false,
            inventoryItem: null,
            matches: [],
            match: null,
            selectingMatch: false,
            creatingMatch: false,
            message: null,
            errored: false,
        };
    },
    computed: {
        unmatchedMatches() {
            return this.matches.filter((match) => {
                return !match.is_matched;
            });
        },
        matchedMatches() {
            return this.matches.filter((match) => {
                return match.is_matched;
            });
        },
        thereAreUnmatchedMatches() {
            return this.unmatchedMatches.length > 0;
        },
        needToConfirmQuantity() {
            return this.match?.unmatched_quantity < this.item.quantity_removed;
        },
        orderItemQuantity() {
            return this.match?.quantity ?? 0;
        },
        quantityToAdd() {
            return this.item?.quantity_removed ?? 0;
        },
        orderItemQuantityAfterAdding() {
            return (
                parseInt(this.orderItemQuantity) + parseInt(this.quantityToAdd)
            );
        },
    },
    mounted() {
        this.getInventory();
    },
    watch: {
        selectingMatch(value) {
            if (value) {
                this.$nextTick(() => {
                    document.getElementById("match").focus();
                });
            }
        },
        creatingMatch(value) {
            if (value) {
                this.$nextTick(() => {
                    document.getElementById("quantity-confirm").focus();
                });
            }
        },
        match(newValue) {
            if (newValue) {
                this.item.order_item_id = newValue.id;
            } else {
                this.item.order_item_id = null;
            }
        },
        "item.inventory_id"() {
            this.item.errors = {};
            this.message = null;
            this.inventoryItem = null;
            this.match = null;
        },
    },
    methods: {
        getInventory() {
            axios
                .get(route("orders.inventory.index", this.order))
                .then((response) => {
                    this.inventory = response.data;
                })
                .catch((error) => {
                    this.errored = true;
                    console.error(error);
                });
        },
        searchInventory() {
            axios
                .get(
                    route(
                        "orders.inventory.show",
                        [this.order, this.item.inventory_id],
                        {
                            quantity: this.item.quantity_removed,
                        }
                    )
                )
                .then((response) => {
                    this.inventoryItem = response.data.inventory;
                    this.message = response.data.message;
                    this.matches = response.data.matches;
                    this.match = response.data.match;
                })
                .catch((error) => {
                    this.errored = true;
                    this.message = error.response.data.message;
                })
                .finally(() => {
                    if (this.match && this.inventoryItem.quantity == 1) {
                        this.addInventory();
                    } else if (this.matches?.length > 0) {
                        this.showMatchOptions();
                    } else if (this.inventoryItem) {
                        this.showAddLineItemDialog();
                    }
                });
        },
        addInventory() {
            if (this.match || this.creatingMatch) {
                this.item
                    .transform((data) => ({
                        ...data,
                        confirm_quantity: this.confirm_quantity,
                    }))
                    .post(route("orders.inventory.store", this.order), {
                        preserveState: true,

                        onSuccess: () => {
                            this.item.inventory_id = null;
                            this.item.quantity_removed = 1;
                            this.match = null;
                            this.creatingMatch = false;
                            this.selectingMatch = false;

                            setTimeout(() => {
                                this.$inertia.visit(
                                    route("orders.show", this.order),
                                    {
                                        preserveScroll: true,
                                        onSuccess: () => {
                                            document
                                                .getElementById("search")
                                                .focus();
                                        },
                                    }
                                );
                            }, 300);
                        },
                    });
                this.$emit("add", this.inventory);
            }
        },
        confirmAddLineItem() {
            this.creatingMatch = true;
            this.selectingMatch = false;
        },

        showMatchOptions() {
            this.selectingMatch = true;
        },
        showAddLineItemDialog() {
            this.creatingMatch = true;
        },
        updateMatch(match) {
            this.match = match;
        },
    },
};
</script>
