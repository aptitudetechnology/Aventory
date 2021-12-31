<template>
    <DeleteButton type="button" @click.stop="confirmOrderItemDeletion" />

    <!-- Delete OrderItem Confirmation Modal -->
    <jet-confirmation-modal
        :show="confirmingOrderItemDeletion"
        @close="confirmingOrderItemDeletion = false"
    >
        <template #title> Remove item from order</template>

        <template #content>
            Are you sure you want to delete this item? This will add all matched
            inventory to this item back in inventory. This action cannot be
            undone.
        </template>

        <template #footer>
            <jet-secondary-button @click="confirmingOrderItemDeletion = false">
                Cancel
            </jet-secondary-button>

            <jet-danger-button
                class="ml-2"
                @click="deleteOrderItem"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Remove Order Item
            </jet-danger-button>
        </template>
    </jet-confirmation-modal>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import DeleteButton from "@/Components/Buttons/DeleteButton.vue";
export default {
    props: ["item"],

    components: {
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
        DeleteButton,
    },

    data() {
        return {
            confirmingOrderItemDeletion: false,
            deleting: false,

            form: this.$inertia.form(),
        };
    },

    methods: {
        confirmOrderItemDeletion() {
            this.confirmingOrderItemDeletion = true;
        },

        deleteOrderItem() {
            this.form.delete(
                route("orders.order-items.destroy", [
                    this.item.order_id,
                    this.item,
                ]),
                {
                    errorBag: "deleteOrderItem",
                    preserveState: false,
                }
            );
        },
    },
};
</script>
