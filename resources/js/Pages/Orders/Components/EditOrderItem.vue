<template>
    <div>
        <edit-button type="button" @click.stop="updatingOrderItem = true"
            >Edit</edit-button
        >
        <jet-dialog-modal
            :show="updatingOrderItem"
            maxWidth="4xl"
            @close="closeForm"
        >
            <template #title>Edit</template>

            <template #description> Edit this order item. </template>

            <template #content>
                <div class="grid grid-cols-6 gap-4">
                    <form
                        @submit.prevent="updateOrderItem"
                        @keydown.enter="updateOrderItem"
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
                                        :checked="form.no_discount"
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
                                        v-model.number="form.quantity"
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
                                    <money-input
                                        id="unit_price"
                                        class="mt-1 block w-full"
                                        required
                                        v-model="form.unit_price"
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
                        :size="selectedSize"
                    />
                </div>
            </template>

            <template #footer>
                <div class="flex justify-between w-full">
                    <jet-secondary-button type="button" @click="closeForm"
                        >Cancel</jet-secondary-button
                    >
                    <jet-button
                        type="submit"
                        @click="updateOrderItem"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        >Save Item</jet-button
                    >
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import EditButton from "@/Components/Buttons/EditButton.vue";
import ProductHoldView from "@/Pages/Orders/Components/ProductHoldView.vue";
import MoneyInput from "@/Components/Forms/MoneyInput.vue";

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
        JetCheckbox,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        TextAreaInput,
        SelectBox,
        EditButton,
        ProductHoldView,
        MoneyInput,
    },
    props: { orderItem: Object, editing: { type: Boolean, default: false } },

    data() {
        return {
            products: this.$page.props.products,
            sizes: this.$page.props.sizes,
            selectedProduct: this.$page.props.products.find(
                (product) => product.id == this.orderItem.product_id
            ),
            selectedSize: this.$page.props.sizes.find(
                (size) => size.id == this.orderItem.size_id
            ),
            updatingOrderItem: this.editing,
            form: this.$inertia.form(this.orderItem),
        };
    },
    watch: {
        editing() {
            this.updatingOrderItem = this.editing;
        },
        selectedProduct() {
            if (this.selectedProduct) {
                this.form.product_id = this.selectedProduct.id;
            } else {
                this.form.product_id = null;
            }
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
        closeForm() {
            this.updatingOrderItem = false;
            this.$emit("close");
        },
        updateOrderItem() {
            this.form.patch(
                route("order-items.update", [
                    this.orderItem.order_id,
                    this.orderItem.id,
                ]),
                {
                    preserveScroll: true,
                    preserveState: false,
                }
            );
        },
    },
};
</script>
