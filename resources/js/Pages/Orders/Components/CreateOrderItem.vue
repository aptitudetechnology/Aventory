<template>
    <div>
        <jet-button type="button" @click="creatingOrderItem = true"
            >New Order Item</jet-button
        >
        <jet-dialog-modal
            maxWidth="4xl"
            :show="creatingOrderItem"
            @close="creatingOrderItem = false"
        >
            <template #title>Add an order item.</template>

            <template #content>
                <div class="grid grid-cols-6 gap-4">
                    <form
                        @submit.prevent="createOrderItem"
                        @keydown.enter="createOrderItem"
                        class="col-span-4"
                    >
                        <div class="grid gap-4">
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="sm:col-span-2 min-w-0">
                                    <select-box
                                        labelValue="Product"
                                        :items="products"
                                        :selectedItem="selectedProduct"
                                        v-model="selectedProduct"
                                    />
                                    <jet-input-error
                                        v-if="!form.product_id"
                                        :message="form.errors.product_id"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="sm:col-span-1">
                                    <select-box
                                        labelValue="Size"
                                        :items="sizes"
                                        :selectedItem="selectedSize"
                                        v-model="selectedSize"
                                    />
                                    <jet-input-error
                                        v-if="!form.size_id"
                                        :message="form.errors.size_id"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="sm:col-span-1 flex items-center">
                                    <jet-checkbox
                                        id="no_discount"
                                        v-model="form.no_discount"
                                        class="mr-2"
                                    ></jet-checkbox>
                                    <jet-label for="no_discount"
                                        >Don't apply Discount?</jet-label
                                    >
                                </div>
                            </div>

                            <div class="grid gap-4 grid-cols-1 sm:grid-cols-3">
                                <div class="sm:col-span-1">
                                    <jet-label
                                        for="original_quantity"
                                        value="Quantity Ordered"
                                    />
                                    <jet-input
                                        id="original_quantity"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                        v-model="form.original_quantity"
                                        required
                                    />
                                    <jet-input-error
                                        v-if="!form.original_quantity"
                                        :message="form.errors.original_quantity"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="sm:col-span-1">
                                    <jet-label
                                        for="quantity"
                                        value="Quantity Confirmed"
                                    />
                                    <jet-input
                                        id="quantity"
                                        type="number"
                                        step="1"
                                        class="mt-1 block w-full"
                                        v-model="form.quantity"
                                        required
                                    />
                                    <jet-input-error
                                        v-if="!form.quantity"
                                        :message="form.errors.quantity"
                                        class="mt-2"
                                    />
                                </div>

                                <div class="sm:col-span-1">
                                    <jet-label
                                        for="unit_price"
                                        value="Unit Price"
                                    />
                                    <jet-input
                                        id="unit_price"
                                        type="number"
                                        step="0.01"
                                        class="mt-1 block w-full"
                                        v-model="form.unit_price"
                                        required
                                    />
                                    <jet-input-error
                                        v-if="!form.unit_price"
                                        :message="form.errors.unit_price"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                    <product-hold-view
                        class="col-span-2"
                        :product="selectedProduct"
                    />
                </div>
            </template>

            <template #footer>
                <div class="flex justify-between items-center w-full">
                    <jet-secondary-button
                        type="button"
                        @click="creatingOrderItem = false"
                        >Cancel</jet-secondary-button
                    >
                    <div>
                        <jet-button
                            type="submit"
                            @click="createOrderItem"
                            :class="[
                                { 'opacity-25': form.processing },
                                ' mb-2 sm:mb-0 sm:mr-2',
                            ]"
                            :disabled="form.processing"
                            >Save and add another Item</jet-button
                        >
                        <jet-button
                            type="submit"
                            @click="saveAndClose"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            >Save and Close</jet-button
                        >
                    </div>
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import ProductHoldView from "./ProductHoldView.vue";
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";

export default {
    components: {
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        JetActionMessage,
        JetButton,
        JetDialogModal,
        JetInput,
        JetCheckbox,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        TextAreaInput,
        SelectBox,
        ProductHoldView,
    },
    props: { order: Object },

    data() {
        return {
            addAnother: true,
            products: this.$page.props.products,
            sizes: this.$page.props.sizes,
            selectedProduct: null,
            selectedSize: null,
            creatingOrderItem: false,
            form: this.$inertia.form({
                _method: "POST",
                product_id: null,
                size_id: null,
                original_quantity: null,
                quantity: null,
                unit_price: null,
                no_discount: false,
            }),
        };
    },
    watch: {
        selectedProduct(product) {
            if (product) {
                this.form.product_id = product.id;
                this.getProductSizes(product);
            } else {
                this.form.product_id = null;
            }
        },
        "form.original_quantity"(value) {
            this.form.quantity = value;
        },
        selectedSize(size) {
            if (size) {
                this.form.size_id = size.id;
            } else {
                this.form.size_id = null;
            }
        },
    },

    methods: {
        getProductSizes(product) {
            axios
                .get(route("api.products.sizes.index", product))
                .then((response) => {
                    this.sizes = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        saveAndClose() {
            this.addAnother = false;
            this.createOrderItem();
        },
        createOrderItem() {
            this.form.post(route("order-items.store", this.order), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    this.form.reset();
                    this.selectedSize = null;
                    this.selectedProduct = null;
                    if (this.addAnother == false) {
                        this.creatingOrderItem = false;
                    }
                },
            });
        },
    },
};
</script>
