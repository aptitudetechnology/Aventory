<template>
    <DeleteButton @click="confirmOrderItemDeletion" />

    <!-- Delete OrderItem Confirmation Modal -->
    <jet-confirmation-modal
        :show="confirmingOrderItemDeletion"
        @close="confirmingOrderItemDeletion = false"
    >
        <template #title> Delete Item </template>

        <template #content>
            Are you sure you want to delete this item? All products in inventory
            associated to this item will be permanentaly deleted from inventory!
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
                Delete Item
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
            this.form.delete(route("order-item.destroy", this.item), {
                errorBag: "deleteOrderItem",
                preserveState: false,
            });
        },
    },
};
</script>
