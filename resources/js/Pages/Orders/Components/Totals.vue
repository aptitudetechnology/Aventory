<template>
    <div>
        <jet-section-title>
            <template #title>Shipping / Tax / Totals</template>
        </jet-section-title>
        <div class="md:flex justify-between items-center">
            <div class="grid gap-2 items-center">
                <p v-if="updatedOrder.processing">Saving...</p>
                <select-box
                    labelValue="Shipping Method"
                    v-model="shipping_method"
                    :selectedItem="shipping_method"
                    :items="shipping_methods"
                    id="shipping_method"
                    @update="updateShippingMethod"
                />
                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label for="shipping_amount">Shipping Amount</jet-label>
                    <jet-input
                        @blur="updateOrder"
                        type="number"
                        v-model="updatedOrder.shipping_amount"
                        id="shipping_amount"
                    />
                </div>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label for="warranty_percentage"
                        >Warrany Percentage</jet-label
                    >
                    <jet-input
                        id="warranty_percentage"
                        type="number"
                        @blur="updateOrder"
                        v-model="updatedOrder.warranty_percentage"
                    />
                </div>
                <div
                    class="
                        grid grid-cols-2
                        gap-4
                        items-center
                        border-t
                        mt-2
                        pt-2
                    "
                >
                    <jet-label class="flex items-center text-lg">
                        <jet-checkbox
                            @change="updateOrder"
                            class="mr-2 mb-1"
                            :checked="updatedOrder.is_taxable"
                            v-model="updatedOrder.is_taxable"
                        />Taxable</jet-label
                    >
                </div>
                <div
                    v-if="order.is_taxable"
                    class="grid grid-cols-2 gap-4 items-center"
                >
                    <jet-label for="tax_percentage">Tax Percentage</jet-label>
                    <jet-input
                        @blur="updateOrder"
                        id="tax_percentage"
                        type="number"
                        v-model="updatedOrder.tax_percentage"
                    />
                </div>
            </div>
            <div
                class="
                    grid
                    gap-2
                    mt-4
                    pt-4
                    border-t
                    md:border-t-0 md:mt-0 md:py-2
                    items-center
                    md:text-right md:justify-end
                "
            >
                <div class="grid grid-cols-2 gap-4 items-center auto-cols-min">
                    <jet-label>Product Total:</jet-label>
                    <p class="text-black">
                        {{ formatMoney(order.total) }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label>Discount Total:</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(order.total_discounts) }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label>Warranty Amount</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(order.warranty_amount) }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label class="text-black">Sub Total</jet-label>
                    <p class="text-black">
                        {{
                            formatMoney(order.total_after_discount_and_warranty)
                        }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label>Shipping Amount</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(updatedOrder.shipping_amount) }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label>Tax Amount</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(order.tax_amount) }}
                    </p>
                </div>

                <div
                    class="
                        grid grid-cols-2
                        gap-4
                        uppercase
                        items-center
                        border-t
                        pt-2
                    "
                >
                    <jet-label class="text-black text-lg"
                        >Grand Total</jet-label
                    >
                    <p class="text-black text-lg">
                        {{ formatMoney(order.grand_total) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import MoneyInput from "@/Components/Forms/MoneyInput.vue";
export default {
    components: { MoneyInput },
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            isFocused: false,
            updatedOrder: this.$inertia.form({ ...this.order }),
            shipping_method: null,
            shipping_methods: this.$page.props.shipping_methods,
        };
    },
    mounted() {
        this.shipping_method = this.shipping_methods.find(
            (method) => method.id === this.order.shipping_method_id
        );
    },
    watch: {
        updatedOrder: {
            handler(newValue) {
                this.$emit("update", newValue);
            },
            deep: true,
        },
    },
    methods: {
        updateShippingMethod() {
            this.updatedOrder.shipping_method_id = this.shipping_method.id;
            this.$nextTick(() => {
                this.updateOrder();
            });
        },
        updateOrder() {
            if (this.updatedOrder.isDirty) {
                this.updatedOrder.patch(route("orders.update", this.order.id));
            }
        },
    },
};
</script>
