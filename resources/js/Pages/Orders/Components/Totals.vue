<template>
    <div>
        <jet-section-title>
            <template #title>Shipping / Tax / Totals</template>
        </jet-section-title>
        <div class="md:grid grid-cols-2 gap-8">
            <div class="grid gap-2 items-center">
                <p v-if="updatedOrder.processing">Saving...</p>
                <select-box
                    labelValue="Shipping Method"
                    v-model="shipping_method"
                    :selectedItem="shipping_method"
                    :items="shipping_methods"
                    id="shipping_method"
                />
                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label for="shipping_amount">Shipping Amount</jet-label>
                    <money-input
                        v-model="updatedOrder.shipping_amount"
                        id="shipping_amount"
                    />
                    <jet-input-error
                        class="col-span-2"
                        :message="updatedOrder.errors.shipping_amount"
                    />
                </div>
                <div class="grid grid-cols-2 gap-4 items-center">
                    <jet-label for="warranty_percentage"
                        >Warrany Percentage</jet-label
                    >
                    <percentage-input
                        id="warranty_percentage"
                        v-model="updatedOrder.warranty_percentage"
                    />
                    <jet-input-error
                        class="col-span-2"
                        :message="updatedOrder.errors.warranty_percentage"
                    />
                </div>
                <div
                    class="grid grid-cols-2 gap-4 items-center border-t mt-2 pt-2"
                >
                    <label class="label justify-start">
                        <jet-checkbox
                            class="mr-2"
                            :checked="updatedOrder.is_taxable"
                            v-model="updatedOrder.is_taxable"
                        /><span class="label-text">Taxable</span></label
                    >
                </div>
                <div
                    v-if="updatedOrder.is_taxable"
                    class="grid grid-cols-2 gap-4 items-center"
                >
                    <jet-label for="tax_percentage">Tax Percentage</jet-label>
                    <percentage-input
                        id="tax_percentage"
                        v-model="updatedOrder.tax_percentage"
                    />
                    <jet-input-error
                        class="col-span-2"
                        :message="updatedOrder.errors.tax_percentage"
                    />
                </div>
            </div>
            <div
                class="grid gap-2 mt-4 pt-4 border-t md:border-t-0 md:mt-0 md:py-2 items-center"
            >
                <div
                    class="flex space-x-4 justify-between items-center auto-cols-min"
                >
                    <jet-label>Product Total</jet-label>
                    <p class="text-black">
                        {{ formatMoney(order.total) }}
                    </p>
                </div>
                <div class="flex space-x-4 justify-between items-center">
                    <jet-label>Discount Total</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(order.total_discounts) }}
                    </p>
                </div>
                <div class="flex space-x-4 justify-between items-center">
                    <jet-label>Warranty Amount</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(order.warranty_amount) }}
                    </p>
                </div>
                <div class="flex space-x-4 justify-between items-center">
                    <jet-label class="text-black">Sub Total</jet-label>
                    <p class="text-black">
                        {{
                            formatMoney(order.total_after_discount_and_warranty)
                        }}
                    </p>
                </div>

                <div class="flex space-x-4 justify-between items-center">
                    <jet-label>Shipping Amount</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(updatedOrder.shipping_amount) }}
                    </p>
                </div>

                <div class="flex space-x-4 justify-between items-center">
                    <jet-label>Tax Amount</jet-label>
                    <p class="text-gray-600">
                        {{ formatMoney(order.tax_amount) }}
                    </p>
                </div>

                <div
                    class="flex space-x-4 justify-between uppercase items-center border-t pt-2"
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
import _debounce from "lodash/debounce";

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
            updatedOrder: this.$inertia.form({
                is_taxable: this.order.is_taxable,
                tax_percentage: this.order.tax_percentage,
                warranty_percentage: this.order.warranty_percentage,
                shipping_method_id: this.order.shipping_method_id,
                shipping_amount: this.order.shipping_amount,
            }),
            shipping_method: null,
            shipping_methods: this.$page.props.shipping_methods,
        };
    },
    mounted() {
        this.shipping_method =
            this.shipping_methods.find(
                (method) => method.id === this.order.shipping_method_id
            ) ?? null;
    },
    watch: {
        shipping_method(value) {
            this.updatedOrder.shipping_method_id = value ? value.id : null;
        },
        "updatedOrder.shipping_method_id": _debounce(function (value) {
            this.updateOrder();
        }, 500),
        "updatedOrder.is_taxable": _debounce(function () {
            this.updateOrder();
        }, 500),
        "updatedOrder.warranty_percentage": _debounce(function () {
            this.updateOrder();
        }, 500),
        "updatedOrder.tax_percentage": _debounce(function () {
            this.updateOrder();
        }, 500),
        "updatedOrder.shipping_amount": _debounce(function () {
            this.updateOrder();
        }, 500),
        order: {
            handler(order) {
                if (!this.updatedOrder.isDirty) {
                    this.updatedOrder = this.$inertia.form(order);
                }
            },
            deep: true,
        },
    },
    methods: {
        sendQuoteChanges() {
            this.updatedOrder.patch(route("quotes.update", this.order.id), {
                errorBag: "updateOrder",
                preserveScroll: true,
            });
        },
        sendOrderChanges() {
            this.updatedOrder.patch(route("orders.update", this.order.id), {
                errorBag: "updateOrder",
                preserveScroll: true,
            });
        },
        updateOrder() {
            if (this.updatedOrder.isDirty && !this.updatedOrder.processing) {
                if (this.order.is_quote) {
                    this.sendQuoteChanges();
                } else {
                    this.sendOrderChanges();
                }
            }
        },
    },
};
</script>
