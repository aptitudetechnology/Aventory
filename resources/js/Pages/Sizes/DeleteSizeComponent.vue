<template>
    <DeleteButton @click="confirmSizeDeletion" :size="6" />

    <!-- Delete Size Confirmation Modal -->
    <jet-confirmation-modal
        :show="confirmingSizeDeletion"
        @close="confirmingSizeDeletion = false"
    >
        <template #title> Delete Size </template>

        <template #content>
            Are you sure you want to delete this size? All products in inventory
            with this size will be given a null size and all product pricing
            with this size will be deleted.
        </template>

        <template #footer>
            <jet-secondary-button @click="confirmingSizeDeletion = false">
                Cancel
            </jet-secondary-button>

            <jet-danger-button
                class="ml-2"
                @click="deleteSize"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Delete Size
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
    props: ["size"],

    components: {
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
        DeleteButton,
    },

    data() {
        return {
            confirmingSizeDeletion: false,
            deleting: false,

            form: this.$inertia.form(),
        };
    },

    methods: {
        confirmSizeDeletion() {
            this.confirmingSizeDeletion = true;
        },

        deleteSize() {
            this.form.delete(route("sizes.destroy", this.size), {
                errorBag: "deleteSize",
                preserveState: false,
            });
        },
    },
};
</script>
