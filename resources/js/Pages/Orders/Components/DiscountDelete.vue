<template>
    <div>
        <jet-danger-button type="button" @click.stop="confirmDiscountDeletion"
            >Remove Discount</jet-danger-button
        >

        <!-- Delete Discount Confirmation Modal -->
        <jet-confirmation-modal
            :show="confirmingDiscountDeletion"
            @close="confirmingDiscountDeletion = false"
        >
            <template #title> Delete Discount </template>

            <template #content>
                Are you sure you want to delete this discount from the order?
                This action cannot be undone.
            </template>

            <template #footer>
                <jet-secondary-button
                    @click="confirmingDiscountDeletion = false"
                >
                    Cancel
                </jet-secondary-button>

                <jet-danger-button
                    class="ml-2"
                    @click="deleteDiscount"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Delete Discount
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </div>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import DeleteButton from "@/Components/Buttons/DeleteButton.vue";
export default {
    props: ["discount"],

    components: {
        JetConfirmationModal,
        JetDangerButton,
        DeleteButton,
    },

    data() {
        return {
            confirmingDiscountDeletion: false,
            deleting: false,

            form: this.$inertia.form(),
        };
    },

    methods: {
        confirmDiscountDeletion() {
            this.confirmingDiscountDeletion = true;
        },

        deleteDiscount() {
            this.form.delete(
                route("sales.discounts.destroy", [
                    this.discount.order_id,
                    this.discount.id,
                ]),
                {
                    errorBag: "deleteDiscount",
                    preserveState: false,
                }
            );
        },
    },
};
</script>
