<template>
    <details-section class="w-full">
        <template #title> Inventory Detail </template>
        <div class="space-y-4 overflow-auto max-h-screen">
            <form
                @submit.prevent="searchInventory"
                class="grid gap-2 sticky top-0 bg-white"
            >
                <jet-input-error :message="message" />
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
                v-for="orderItem in inventory"
                :key="orderItem.id"
                class="
                    flex
                    items-center
                    overflow-hidden
                    space-x-4
                    justify-between
                    w-full
                "
            >
                <div class="w-1/4">{{ orderItem.size_name }}</div>
                <div class="truncate w-1/2">
                    {{ orderItem.product_name }}
                </div>
                <div class="w-1/4">{{ orderItem.quantity }}</div>
            </div>
        </div>
    </details-section>
</template>
<script>
import SearchInput from "@/Components/Forms/SearchInput.vue";
import axios from "axios";
export default {
    components: {
        SearchInput,
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
                quantity: 1,
            }),
            inventory: [],
            matches: [],
            match: null,
            message: null,
            errored: false,
        };
    },
    mounted() {
        this.getInventory();
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
                    route("orders.inventory.show", [
                        this.order,
                        this.item.inventory_id,
                    ])
                )
                .then((response) => {
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

                    this.item.inventory_id = null;
                });
        },
        addInventory() {
            this.item.post(route("orders.inventory.store", this.order), {
                preserveState: true,
                onSuccess: () => {
                    this.getInventory();
                    this.item.reset();
                },
            });
            this.$emit("add", this.inventory);
        },

        showMatchOptions() {},
    },
};
</script>
