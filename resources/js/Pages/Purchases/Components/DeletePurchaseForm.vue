<template>
    <jet-action-section>
        <template #title> Delete Purchase</template>

        <template #description>
            Delete this purchase, purchase items, and associated inventory.
        </template>

        <template #content>
            <div class="text-sm text-gray-600">
                If this purchase is deleted, all associated purchase items, and
                inventory already added will be removed. Only delete this
                purchase if you are sure you want to remove all inventory and
                items associated with this purchase.
            </div>

            <div class="mt-5">
                <jet-danger-button @click="confirmPurchaseDeletion">
                    Delete Purchase
                </jet-danger-button>
            </div>

            <!-- Delete Purchase Confirmation Modal -->
            <jet-confirmation-modal
                :show="confirmingPurchaseDeletion"
                @close="confirmingPurchaseDeletion = false"
            >
                <template #title> Delete Purchase </template>

                <template #content>
                    Are you sure you want to delete this purchase? There will be
                    no way to recover it, or inventory associated!
                </template>

                <template #footer>
                    <jet-secondary-button
                        @click="confirmingPurchaseDeletion = false"
                    >
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button
                        class="ml-2"
                        @click="deletePurchase"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Delete Purchase
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
    props: ["purchase"],

    components: {
        JetActionSection,
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
    },

    data() {
        return {
            confirmingPurchaseDeletion: false,
            deleting: false,

            form: this.$inertia.form(),
        };
    },

    methods: {
        confirmPurchaseDeletion() {
            this.confirmingPurchaseDeletion = true;
        },

        deletePurchase() {
            this.form.delete(route("purchases.destroy", this.purchase), {
                errorBag: "deletePurchase",
            });
        },
    },
};
</script>
