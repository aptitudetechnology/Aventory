<template>
    <span
        @click="editingItem = true"
        class="px-1 py-1 text-sm text-gray-700 cursor-pointer"
    >
        {{
            "#" +
            archivedItem.inventory_id +
            " Qty: " +
            archivedItem.quantity_removed
        }}
        <dialog-modal @close="editingItem = false" :show="editingItem">
            <template #title> Edit Inventory Item </template>
            <template #aside>
                <jet-danger-button
                    class="ml-auto flex justify-end"
                    @click="confirmDeletion"
                    >Unmatch Item</jet-danger-button
                >
            </template>
            <template #content>
                <form @keydown.enter.prevent="updateItem">
                    <div class="mb-2">
                        <span class="font-bold">Inventory Item:</span>
                        {{ item.product_name }}
                    </div>
                    <div class="mb-2">
                        <span class="font-bold">Inventory Size:</span>
                        {{ item.size_name }}
                    </div>
                    <div class="mb-4">
                        <span class="font-bold">Inventory ID #:</span>
                        {{ item.inventory_id }}
                    </div>

                    <jet-input-error :message="item.errors.quantity_removed" />
                    <div class="flex items-center justify-between">
                        <jet-label for="quantity">Quantity</jet-label>
                        <jet-input
                            id="quantity"
                            type="number"
                            :error="item.errors.quantity_removed ? true : false"
                            v-model="item.quantity_removed"
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
                        @click="updateItem"
                        class="ml-auto flex justify-end"
                        :disabled="!item.isDirty"
                        >Update Item</jet-button
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
    },
    components: {
        DialogModal,
        ConfirmationModal,
    },
    data() {
        return {
            editingItem: false,
            confirmingDeletion: false,
            item: this.$inertia.form(this.archivedItem),
        };
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
            this.item.patch(
                route("inventory-archive.update", {
                    inventory_archive: this.archivedItem.id,
                }),

                {
                    onSuccess: () => {
                        this.editingItem = false;
                        this.$emit("update");
                    },
                }
            );
        },
    },
};
</script>
