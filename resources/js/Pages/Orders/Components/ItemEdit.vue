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
            <template #aside
                ><jet-button
                    v-show="selectedProduct"
                    @click.stop="viewInventory(selectedProduct)"
                    >View Inventory</jet-button
                ></template
            >

            <template #description> Edit this order item. </template>

            <template #content>
                <div class="grid md:grid-cols-6 gap-4">
                    <form
                        @submit.prevent="updateOrderItem"
                        @keydown.enter="updateOrderItem"
                        class="md:col-span-4"
                    >
                        <div class="grid gap-4">
                            <div class="grid gap-4 sm:grid-cols-2 items-center">
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
                                <div>
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
                                    <div class="flex items-center mt-4">
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
                                <InventoryDetail
                                    @update="updateQuantity"
                                    :product="selectedProduct"
                                    :size="selectedSize"
                                />
                            </div>

                            <div class="grid gap-4 grid-cols-1 sm:grid-cols-3">
                                <div>
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
                                <div>
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

                                <div>
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
                        class="md:col-span-2"
                        :orderId="orderItem.order_id"
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

        <jet-confirmation-modal
            :show="confirmingQuantity"
            @close="confirmingQuantity = false"
        >
            <template #title> Confirm Quantity </template>

            <template #content>
                The amount of {{ selectedProduct.name }} available for sale is:
                {{ availableForSale }}. Are you sure you want to add
                {{ form.quantity }} to this order?
            </template>

            <template #footer>
                <jet-secondary-button
                    @click.native="confirmingQuantity = false"
                >
                    Nevermind Edit
                </jet-secondary-button>

                <jet-button
                    class="ml-2"
                    @click.native="confirmed"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Yes, Confirm
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </div>
</template>

<script>
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";

import JetDialogModal from "@/Jetstream/DialogModal";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetActionMessage from "@/Jetstream/ActionMessage";
import EditButton from "@/Components/Buttons/EditButton.vue";
import ProductHoldView from "@/Pages/Orders/Components/ProductHoldView.vue";
import MoneyInput from "@/Components/Forms/MoneyInput.vue";
import InventoryDetail from "./InventoryDetail.vue";

export default {
    components: {
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        JetDialogModal,
        JetConfirmationModal,
        JetActionMessage,
        EditButton,
        ProductHoldView,
        MoneyInput,
        InventoryDetail,
    },

    props: {
        orderItem: Object,
        editing: { type: Boolean, default: false },
    },

    data() {
        return {
            priceLevelId:
                this.$page.props.order?.customer?.customer_price_level_id,
            products: this.$page.props.products,
            sizes: this.$page.props.sizes,
            selectedProduct: this.$page.props.products.find(
                (product) => product.id == this.orderItem.product_id
            ),
            selectedSize: this.$page.props.sizes.find(
                (size) => size.id == this.orderItem.size_id
            ),
            updatingOrderItem: this.editing,
            confirmedQuantity: false,
            confirmingQuantity: false,
            availableForSale: 0,
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
            this.getProductPrice();
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

        closeForm() {
            this.updatingOrderItem = false;
            this.$emit("close");
        },
        updateOrderItem() {
            if (this.form.quantity > this.availableForSale) {
                this.confirmingQuantity = true;
            } else {
                this.confirmed();
            }
        },
        confirmed() {
            this.confirmingQuantity = false;
            this.confirmedQuantity = true;
            this.update();
        },
        update() {
            if (this.confirmedQuantity) {
                this.form.patch(
                    route("orders.order-items.update", [
                        this.orderItem.order_id,
                        this.orderItem.id,
                    ]),
                    {
                        preserveScroll: true,
                        preserveState: false,
                    }
                );
            }
        },
    },
};
</script>
