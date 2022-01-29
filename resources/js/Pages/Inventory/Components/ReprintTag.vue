<template>
    <div class="pt-4 flex flex-col items-center">
        <DialogModal
            @close="confirmingQuantity = false"
            :show="confirmingQuantity"
        >
            <template #title> How many tags would you like to print? </template>
            <template #content>
                <jet-input
                    class="w-full"
                    :min="1"
                    :max="inventory.quantity"
                    type="number"
                    v-model="form.quantity"
                />
            </template>

            <template #footer>
                <div class="flex items-center justify-between">
                    <jet-secondary-button
                        @click="confirmingQuantity = false"
                        class="mr-4 ml-0"
                        >Cancel</jet-secondary-button
                    >
                    <jet-button type="submit" @click="sendToQueue"
                        >Send to Queue</jet-button
                    >
                </div>
            </template>
        </DialogModal>
        <print-button
            :disabled="form.processing"
            @click="confirmQuantity"
            type="button"
            >Send Inventory to Print Queue</print-button
        >
        <ErrorMessage class="mt-4" v-if="form.hasErrors" />
    </div>
</template>

<script>
import PrintButton from "@Components/Buttons/PrintButton.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import ErrorMessage from "@Components/ErrorMessage.vue";
export default {
    components: {
        PrintButton,
        DialogModal,
        ErrorMessage,
    },
    props: {
        inventory: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            confirmingQuantity: false,
            quantityConfirmed: false,
            form: this.$inertia.form({
                inventory: this.inventory.id,
                quantity: this.inventory.quantity,
            }),
        };
    },

    methods: {
        sendToQueue() {
            this.printing = true;
            this.form.post(route("reprint-queue.store"), {
                onSuccess: () => {
                    this.confirmingQuantity = false;
                },
            });
        },
        confirmQuantity() {
            if (this.inventory.quantity > 1) {
                this.confirmingQuantity = true;
            } else {
                this.sendToQueue();
            }
        },
    },
};
</script>
