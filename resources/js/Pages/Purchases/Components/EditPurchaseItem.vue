<template>
    <div>
        <edit-button @click="updatingPurchaseItem = true">Edit</edit-button>
        <jet-dialog-modal
            :show="updatingPurchaseItem"
            @close="updatingPurchaseItem = false"
        >
            <template #title>Edit</template>

            <template #description> Edit this purchase item. </template>

            <template #content>
                <form
                    @submit.prevent="updatePurchaseItem"
                    @keydown.enter="updatePurchaseItem"
                >
                    <div class="col-span-6 grid gap-4">
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
                                    labelValue="Purchase Size"
                                    :items="sizes"
                                    :selectedItem="selectedOriginalSize"
                                    v-model="selectedOriginalSize"
                                />
                                <jet-input-error
                                    v-if="!form.size_id"
                                    :message="form.errors.size_id"
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
                        </div>

                        <div class="grid gap-4 grid-cols-1 sm:grid-cols-3">
                            <div class="sm:col-span-1">
                                <jet-label
                                    for="quantity_ordered"
                                    value="Quantity Purchaseed"
                                />
                                <jet-input
                                    id="quantity_ordered"
                                    type="number"
                                    step="1"
                                    class="mt-1 block w-full"
                                    v-model="form.quantity_ordered"
                                    required
                                />
                                <jet-input-error
                                    v-if="!form.quantity_ordered"
                                    :message="form.errors.quantity_ordered"
                                    class="mt-2"
                                />
                            </div>
                            <div class="sm:col-span-1">
                                <jet-label
                                    for="quantity_confirmed"
                                    value="Quantity Confirmed"
                                />
                                <jet-input
                                    id="quantity_confirmed"
                                    type="number"
                                    step="1"
                                    class="mt-1 block w-full"
                                    v-model="form.quantity_confirmed"
                                    required
                                />
                                <jet-input-error
                                    v-if="!form.quantity_confirmed"
                                    :message="form.errors.quantity_confirmed"
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
                        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <jet-label
                                    for="ready_date"
                                    value="Ready Date"
                                />
                                <jet-input
                                    id="ready_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.ready_date"
                                    required
                                />
                                <jet-input-error
                                    v-if="!form.ready_date"
                                    :message="form.errors.ready_date"
                                    class="mt-2"
                                />
                            </div>
                            <SwitchGroup
                                as="div"
                                class="
                                    flex
                                    justify-start
                                    items-center
                                    sm:col-span-1
                                "
                            >
                                <SwitchLabel
                                    as="span"
                                    class="
                                        text-sm
                                        font-medium
                                        text-gray-900
                                        mr-4
                                    "
                                    >Received?</SwitchLabel
                                >
                                <Switch
                                    v-model="form.received"
                                    :class="[
                                        form.received
                                            ? 'bg-green-600'
                                            : 'bg-gray-200',
                                        'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                                    ]"
                                >
                                    <span
                                        aria-hidden="true"
                                        :class="[
                                            form.received
                                                ? 'translate-x-5'
                                                : 'translate-x-0',
                                            'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                        ]"
                                    />
                                </Switch>
                            </SwitchGroup>
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <div class="flex justify-between w-full">
                    <jet-secondary-button
                        type="button"
                        @click="updatingPurchaseItem = false"
                        >Cancel</jet-secondary-button
                    >
                    <jet-button
                        type="submit"
                        @click="updatePurchaseItem"
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
import JetButton from "@/Jetstream/Button.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import EditButton from "@/Components/Buttons/EditButton.vue";

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
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        TextAreaInput,
        SelectBox,
        EditButton,
    },
    props: { purchaseItem: Object },

    data() {
        return {
            products: this.$page.props.products,
            sizes: this.$page.props.sizes,
            selectedProduct: this.$page.props.products.find(
                (product) => product.id == this.purchaseItem.product_id
            ),
            selectedOriginalSize: this.$page.props.sizes.find(
                (size) => size.id == this.purchaseItem.original_size_id
            ),
            selectedSize: this.$page.props.sizes.find(
                (size) => size.id == this.purchaseItem.size_id
            ),
            updatingPurchaseItem: false,
            form: this.$inertia.form(this.purchaseItem),
        };
    },
    watch: {
        selectedProduct() {
            if (this.selectedProduct) {
                this.form.product_id = this.selectedProduct.id;
            } else {
                this.form.product_id = null;
            }
        },
        selectedOriginalSize(size) {
            if (size) {
                this.form.original_size_id = size.id;
                if (!this.selectedSize) {
                    this.selectedSize = size;
                }
            } else {
                this.form.original_size_id = null;
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
        updatePurchaseItem() {
            this.form.patch(route("purchase-item.update", this.purchaseItem), {
                preserveScroll: true,
                preserveState: false,
            });
        },
    },
};
</script>
