<template>
    <div>
        <jet-button type="button" @click="creatingOrderItem = true"
            ><PlusIcon class="w-4 h-4 mr-2" />New Order Item</jet-button
        >
        <jet-dialog-modal
            maxWidth="4xl"
            :show="creatingOrderItem"
            @close="creatingOrderItem = false"
        >
            <template #title>Add an order item.</template>
            <template #aside
                ><jet-button
                    v-show="selectedProduct"
                    @click="viewInventory(selectedProduct)"
                    >View Inventory</jet-button
                ></template
            >
            <template #content>
                <div class="grid md:grid-cols-6 gap-4">
                    <form
                        @submit.prevent="createOrderItem"
                        @keydown.enter="createOrderItem"
                        class="md:col-span-4"
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
                                    <div
                                        class="sm:col-span-1 flex items-center mt-4"
                                    >
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
                                <InventoryDetail
                                    @update="updateQuantity"
                                    :product="selectedProduct"
                                    :size="selectedSize"
                                />
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
                        class="md:col-span-2"
                        :orderId="order.id"
                        :product="selectedProduct"
                        :size="selectedSize"
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
import JetDialogModal from "@/Jetstream/DialogModal";
import JetActionMessage from "@/Jetstream/ActionMessage";
import ProductHoldView from "./ProductHoldView.vue";
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";

import { PlusIcon } from "@heroicons/vue/outline";
import InventoryDetail from "./InventoryDetail.vue";

export default {
    components: {
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        JetActionMessage,
        JetDialogModal,
        ProductHoldView,
        PlusIcon,
        InventoryDetail,
    },
    props: { order: Object },

    data() {
        return {
            priceLevelId:
                this.$page.props.order?.customer?.customer_price_level_id,
            addAnother: true,
            products: this.$page.props.products,
            sizes: this.$page.props.sizes,
            selectedProduct: null,
            selectedSize: null,
            creatingOrderItem: false,
            availableForSale: 0,
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
            } else {
                this.form.product_id = null;
            }
            this.getProductPrice();
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
            this.getProductPrice();
        },
    },

    methods: {
        getProductPrice() {
            if (this.selectedProduct && this.selectedSize) {
                axios
                    .get(
                        route("api.product.prices", [
                            this.selectedProduct.id,
                            this.selectedSize.id,
                        ])
                    )
                    .then((response) => {
                        let price = response.data.find(
                            (price) =>
                                price.price_level_id == this.priceLevelId ??
                                null
                        ).price;
                        this.form.unit_price = price;
                        return;
                    });
            } else {
                this.form.unit_price = 0;
            }
        },
        updateQuantity(quantityData) {
            this.availableForSale = quantityData.availableForSale;
        },
        viewInventory(product) {
            this.showPopup(
                route("view.show", { id: product.id }),
                "View Inventory"
            );
        },
        saveAndClose() {
            this.addAnother = false;
            this.createOrderItem();
        },
        createOrderItem() {
            this.form.post(route("sales.order-items.store", this.order), {
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
