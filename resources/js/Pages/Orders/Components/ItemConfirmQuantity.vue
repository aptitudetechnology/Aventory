<template>
    <jet-confirmation-modal
        :show="confirmingQuantity"
        @close="confirmingQuantity = false"
    >
        <template #title> Confirm Quantity </template>

        <template #content>
            The amount of {{ selectedProduct?.name }} available for sale is:
            {{ quantityAvailable }}. Are you sure you want to add
            {{ quantity }} to this order?
        </template>

        <template #footer>
            <jet-secondary-button @click.native="confirmingQuantity = false">
                Nevermind Edit
            </jet-secondary-button>

            <jet-button class="ml-2" @click.native="confirmed">
                Yes, Confirm
            </jet-button>
        </template>
    </jet-confirmation-modal>
</template>
<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";

export default {
    components: {
        JetConfirmationModal,
    },
    props: {
        selectedProduct: {
            type: Object,
            required: false,
        },
        quantity: {
            type: Number,
            required: false,
        },
        quantityAvailable: {
            type: Number,
            required: false,
        },
        show: {
            type: Boolean,
            required: true,
        },
    },
    data() {
        return {
            confirmingQuantity: this.show,
        };
    },
    watch: {
        show() {
            this.confirmingQuantity = this.show;
        },
    },
    emits: ["quantity-confirmed"],
    methods: {
        confirmed() {
            this.confirmingQuantity = false;
            this.$emit("quantity-confirmed");
        },
    },
};
</script>
