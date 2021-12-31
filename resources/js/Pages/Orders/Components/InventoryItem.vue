<template>
    <span
        @click="editingItem = true"
        class="m-1 btn btn-xs btn-ghost bg-gray-100 cursor-pointer"
    >
        {{
            "#" +
            archivedItem.inventory_id +
            (archivedItem.quantity_removed > 1
                ? " Qty: " + archivedItem.quantity_removed
                : "")
        }}
        <dialog-modal @close="editingItem = false" :show="editingItem">
            <template #title> Edit Inventory Item </template>
            <template #aside>
                <jet-danger-button
                    v-if="itemIsGroup"
                    class="ml-auto flex justify-end"
                    @click="confirmDeletion"
                    >Unmatch Item</jet-danger-button
                >
            </template>
            <template #content>
                <form class="grid gap-4" @keydown.enter.prevent="updateItem">
                    <div class="grid gap-4 grid-cols-2">
                        <jet-label class="col-span-1">
                            <span class="font-bold">Product:</span>
                            {{ item.product_name }}
                        </jet-label>
                        <jet-label>
                            <span class="font-bold">Qty in Order:</span>
                            {{ orderItemQuantity }}
                        </jet-label>
                        <jet-label>
                            <span class="font-bold">Inventory ID #:</span>
                            {{ item.inventory_id }}
                        </jet-label>

                        <jet-label>
                            <span class="font-bold">Size:</span>
                            {{ item.size_name }}
                        </jet-label>
                    </div>
                    <div v-if="itemIsGroup">
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
                                    item.errors.quantity_removed ? true : false
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
                                {{ orderItemQuantityAfterAdding }}?</jet-label
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
                </form>
            </template>
            <template #footer>
                <div class="flex items-center justify-between">
                    <jet-secondary-button @click="editingItem = false"
                        >Cancel</jet-secondary-button
                    >
                    <jet-button
                        v-if="itemIsGroup"
                        @click="updateItem"
                        class="ml-auto flex justify-end"
                        :disabled="!item.isDirty"
                        >Update Item</jet-button
                    >
                    <jet-danger-button
                        v-else
                        class="ml-auto flex justify-end"
                        @click="confirmDeletion"
                        >Unmatch Item</jet-danger-button
                    >
                </div>
            </template>
        </dialog-modal>
        <confirmation-modal
            :show="confirmingDeletion"
            @close="confirmingDeletion = false"
        >
            <template #title> Unmatch Inventory Item </template>
            <template #content>
                <p>
                    Are you sure you want to unmatch this item? This will
                    restore the item to inventory, and unmatch it from this
                    order.
                </p>
            </template>
            <template #footer>
                <div class="flex items-center justify-between">
                    <jet-secondary-button @click="confirmingDeletion = false"
                        >No, Cancel</jet-secondary-button
                    >
                    <jet-danger-button
                        @click="deleteItem"
                        class="ml-auto flex justify-end"
                        >Unmatch Item</jet-danger-button
                    >
                </div>
            </template>
        </confirmation-modal>
    </span>
</template>
<script>
import DialogModal from "@/Jetstream/DialogModal.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
export default {
    props: {
        archivedItem: Object,
        order: Object,
        quantity_left: Number,
    },
    components: {
        DialogModal,
        ConfirmationModal,
    },
    data() {
        return {
            editingItem: false,
            confirmingDeletion: false,
            confirm_quantity: false,
            item: this.$inertia.form(this.archivedItem),
        };
    },
    computed: {
        needToConfirmQuantity() {
            return this.quantityToAdd > this.quantity_left;
        },
        orderItemQuantity() {
            return this.archivedItem.order_item_quantity;
        },
        quantityToAdd() {
            return (
                parseInt(this.item.quantity_removed) -
                parseInt(this.archivedItem.quantity_removed)
            );
        },
        orderItemQuantityAfterAdding() {
            return (
                parseInt(this.orderItemQuantity) + parseInt(this.quantityToAdd)
            );
        },
        itemIsGroup() {
            return this.archivedItem.inventory_is_group;
        },
    },
    methods: {
        confirmDeletion() {
            this.confirmingDeletion = true;
        },
        deleteItem() {
            this.item.delete(
                route("inventory-archive.destroy", {
                    inventory_archive: this.archivedItem.id,
                }),

                {
                    preserveState: false,
                }
            );
        },
        updateItem() {
            console.log(this.item);
            this.item.patch(
                route("inventory-archive.update", {
                    inventory_archive: this.archivedItem.id,
                    confirm_quantity: this.confirm_quantity ? 1 : null,
                }),

                {
                    onSuccess: () => {
                        this.$inertia.visit(
                            route("orders.show", {
                                order: this.order.id,
                            })
                        );
                    },
                }
            );
        },
    },
};
</script>
