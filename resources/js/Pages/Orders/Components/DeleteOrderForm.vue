<template>
    <jet-action-section>
        <template #title> Delete Order</template>

        <template #description>
            Delete this order, order items, and associated inventory.
        </template>

        <template #content>
            <div class="text-sm text-gray-600">
                If this order is deleted, all associated order items, and
                inventory already added will be removed. Only delete this order
                if you are sure you want to remove all inventory and items
                associated with this order.
            </div>

            <div class="mt-5">
                <jet-danger-button @click="confirmOrderDeletion">
                    Delete Order
                </jet-danger-button>
            </div>

            <!-- Delete Order Confirmation Modal -->
            <jet-confirmation-modal
                :show="confirmingOrderDeletion"
                @close="confirmingOrderDeletion = false"
            >
                <template #title> Delete Order </template>

                <template #content>
                    Are you sure you want to delete this order? There will be no
                    way to recover it, or inventory associated!
                </template>

                <template #footer>
                    <jet-secondary-button
                        @click="confirmingOrderDeletion = false"
                    >
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button
                        class="ml-2"
                        @click="deleteOrder"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Delete Order
                    </jet-danger-button>
                </template>
            </jet-confirmation-modal>
        </template>
    </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    props: ["order"],

    components: {
        JetActionSection,
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
    },

    data() {
        return {
            confirmingOrderDeletion: false,
            deleting: false,

            form: this.$inertia.form(),
        };
    },

    methods: {
        confirmOrderDeletion() {
            this.confirmingOrderDeletion = true;
        },

        deleteOrder() {
            this.form.delete(route("orders.destroy", this.order), {
                errorBag: "deleteOrder",
            });
        },
    },
};
</script>
