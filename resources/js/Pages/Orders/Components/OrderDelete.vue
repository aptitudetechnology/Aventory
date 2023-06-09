<template>
    <jet-action-section>
        <template #title
            ><span class="capitalize">Delete {{ order.type }}</span></template
        >

        <template #content>
            <div class="text-sm text-gray-600">
                If this {{ order.type }} is deleted, all associated products and
                services, associated shipments, and associated invoices will be
                deleted. This is permanent and cannot be undone.
            </div>

            <div class="mt-5">
                <jet-danger-button @click="confirmOrderDeletion">
                    Delete {{ order.type }}
                </jet-danger-button>
            </div>

            <!-- Delete Order Confirmation Modal -->
            <jet-confirmation-modal
                :show="confirmingOrderDeletion"
                @close="confirmingOrderDeletion = false"
            >
                <template #title
                    ><span class="capitalize">
                        Delete {{ order.type }}
                    </span></template
                >

                <template #content>
                    Are you sure you want to delete this {{ order.type }}? There
                    will be no way to recover it.
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
                        :disabled="form.processing"
                    >
                        Yes, Delete
                    </jet-danger-button>
                </template>
            </jet-confirmation-modal>
        </template>
    </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

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
            if (this.order.is_quote) {
                this.form.delete(route("quotes.destroy", this.order.id));
            } else {
                this.form.delete(route("orders.destroy", this.order.id));
            }
        },
    },
};
</script>
