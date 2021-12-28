<template>
    <details-section class="w-full">
        <template #title> Inventory Detail </template>
        <div class="space-y-4 overflow-hidden max-h-screen">
            <form
                @submit.prevent="searchInventory"
                class="grid gap-2 sticky top-0 bg-white px-1"
            >
                <jet-input-error v-show="!selectingMatch" :message="message" />
                <jet-input-error
                    v-show="!selectingMatch"
                    :message="item.errors.quantity"
                />
                <div class="flex items-end space-x-2">
                    <div class="w-1/2">
                        <jet-label for="search">Inventory ID</jet-label>
                        <search-input
                            id="search"
                            ref="search"
                            @focus.native="$event.target.select()"
                            :placeholder="'Search by Inventory ID'"
                            required
                            v-model="item.inventory_id"
                        />
                    </div>

                    <div class="w-1/4">
                        <jet-label for="quantity">Quantity</jet-label>
                        <jet-input
                            id="quantity"
                            type="number"
                            min="1"
                            v-model="item.quantity"
                            class="w-full"
                        />
                    </div>

                    <jet-button type="submit" class="text-center">
                        Add
                    </jet-button>
                </div>
            </form>
            <div
                :data-tip="`${
                    orderItem.is_matched
                        ? 'Matched to Inventory: '
                        : 'NOT Matched to Inventory: '
                }${orderItem.size_name} - ${orderItem.product_name}`"
                v-for="orderItem in inventory"
                :key="orderItem.id"
                class="w-full tooltip"
            >
                <div
                    class="
                        flex
                        items-center
                        overflow-hidden
                        space-x-2
                        w-full
                        tracking-wider
                        uppercase
                        text-gray-900
                        px-1
                    "
                >
                    <CheckCircleIcon
                        class="w-6 h-6 text-green-500 stroke-current mr-0"
                        v-if="orderItem.is_matched"
                    />
                    <ExclamationCircleIcon
                        class="w-6 h-6 text-yellow-500 stroke-current mr-0"
                        v-else
                    />
                    <div class="w-1/4 ml-0 mr-auto">
                        {{ orderItem.size_name }}
                    </div>
                    <div class="truncate w-1/2">
                        {{ orderItem.product_name }}
                    </div>
                    <div class="w-1/4">{{ `Qty: ${orderItem.quantity}` }}</div>
                </div>
                <div class="flex flex-wrap">
                    <span
                        v-for="inventoryItem in orderItem.inventory"
                        :key="inventoryItem.id"
                        class="px-1 py-1 text-sm text-gray-700"
                    >
                        {{
                            "#" +
                            inventoryItem.id +
                            " Qty: " +
                            inventoryItem.archive.quantity_removed
                        }}
                    </span>
                    <div
                        v-if="!orderItem.inventory.length"
                        class="px-1 py-1 text-sm text-gray-700"
                    >
                        No Inventory matched.
                    </div>
                </div>
            </div>
        </div>
        <dialog-modal @close="selectingMatch = false" :show="selectingMatch">
            <template #title>Select Match</template>
            <template #description>
                <span>
                    Select the order item to match
                    {{ inventoryItem.id }} inventory item to.
                </span>
                <jet-input-error :message="message" />
            </template>
            <template #content>
                <form @keydown.enter.prevent="addInventory">
                    <RadioListSelect
                        v-model="match"
                        :label="'Select Match'"
                        nameValue="product_name"
                        descriptionValue="size_name"
                        :options="matches"
                        :selectedItem="match"
                        @update="updateMatch"
                        class="mb-4"
                    />
                    <jet-input-error :message="item.errors.quantity" />
                    <div class="flex items-center justify-between mt-2">
                        <jet-label for="quantity">Quantity</jet-label>
                        <jet-input
                            type="number"
                            v-model="item.quantity"
                            :error="item.errors.quantity ? true : false"
                        ></jet-input>
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
import { ExclamationCircleIcon, CheckCircleIcon } from "@heroicons/vue/outline";
import DialogModal from "@/Jetstream/DialogModal.vue";
import RadioListSelect from "@Components/Forms/RadioListSelect.vue";
import axios from "axios";
export default {
    components: {
        SearchInput,
        ExclamationCircleIcon,
        CheckCircleIcon,
        DialogModal,
        RadioListSelect,
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
                quantity: 1,
            }),
            inventory: [],
            inventoryItem: null,
            matches: [],
            match: null,
            selectingMatch: false,
            message: null,
            errored: false,
        };
    },
    mounted() {
        this.getInventory();
    },
    watch: {
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
                            quantity: this.item.quantity,
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
                    if (this.match) {
                        this.addInventory();
                    } else if (this.matches?.length > 0) {
                        this.showMatchOptions();
                    }
                });
        },
        addInventory() {
            this.item.post(route("orders.inventory.store", this.order), {
                preserveState: true,
                onSuccess: () => {
                    this.getInventory();
                    this.item.reset();
                    this.selectingMatch = false;
                    this.match = null;
                },
            });
            this.$emit("add", this.inventory);
        },

        showMatchOptions() {
            this.selectingMatch = true;
        },
        updateMatch(match) {
            this.match = match;
        },
    },
};
</script>
