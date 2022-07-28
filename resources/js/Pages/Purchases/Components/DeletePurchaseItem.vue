<template>
    <DeleteButton @click="confirmPurchaseItemDeletion" />

    <!-- Delete PurchaseItem Confirmation Modal -->
    <jet-confirmation-modal
        :show="confirmingPurchaseItemDeletion"
        @close="confirmingPurchaseItemDeletion = false"
    >
        <template #title> Delete Item </template>

        <template #content>
            Are you sure you want to delete this item? All products in inventory
            associated to this item will be permanentaly deleted from inventory!
        </template>

        <template #footer>
            <jet-secondary-button
                @click="confirmingPurchaseItemDeletion = false"
            >
                Cancel
            </jet-secondary-button>

            <jet-danger-button
                class="ml-2"
                @click="deletePurchaseItem"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Delete Item
            </jet-danger-button>
        </template>
    </jet-confirmation-modal>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
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
            confirmingPurchaseItemDeletion: false,
            deleting: false,

            form: this.$inertia.form(),
        };
    },

    methods: {
        confirmPurchaseItemDeletion() {
            this.confirmingPurchaseItemDeletion = true;
        },

        deletePurchaseItem() {
            this.form.delete(route("purchase-item.destroy", this.item), {
                errorBag: "deletePurchaseItem",
                preserveState: false,
            });
        },
    },
};
</script>
