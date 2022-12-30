<template>
    <TrashIcon
        @click="confirmPriceDeletion"
        class="w-6 h-6 mx-auto cursor-pointer"
    />

    <!-- Delete Price Confirmation Modal -->
    <jet-confirmation-modal
        :show="confirmingPriceDeletion"
        @close="confirmingPriceDeletion = false"
    >
        <template #title> Delete Price </template>

        <template #content>
            Are you sure you want to delete this price? All products in
            inventory with this price will be given a null price and all product
            pricing with this price will be deleted.
        </template>

        <template #footer>
            <jet-secondary-button @click="confirmingPriceDeletion = false">
                Cancel
            </jet-secondary-button>

            <jet-danger-button
                class="ml-2"
                @click="deletePrice"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Delete Price
            </jet-danger-button>
        </template>
    </jet-confirmation-modal>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { TrashIcon } from "@heroicons/vue/24/outline";
export default {
    props: ["price"],

    components: {
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
        TrashIcon,
    },

    data() {
        return {
            confirmingPriceDeletion: false,
            deleting: false,

            form: this.$inertia.form(),
        };
    },

    methods: {
        confirmPriceDeletion() {
            this.confirmingPriceDeletion = true;
        },

        deletePrice() {
            this.form.delete(route("prices.destroy", this.price), {
                errorBag: "deletePrice",
                preserveState: true,
            });
        },
    },
};
</script>
