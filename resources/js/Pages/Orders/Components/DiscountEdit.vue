<template>
    <div>
        <jet-dialog-modal maxWidth="3xl" :show="editingDiscount" @close="close">
            <template #title>Add a discount to apply to this order.</template>
            <template #content>
                <div class="grid grid-cols-6 gap-4">
                    <form
                        @submit.prevent="createDiscount"
                        @keydown.enter="createDiscount"
                        class="col-span-6 grid gap-4 md:grid-cols-5 items-start"
                    >
                        <div class="grid gap-2 md:col-span-3">
                            <jet-label for="description"
                                >Discount Description</jet-label
                            >
                            <text-area-input
                                required
                                v-model="updatedDiscount.description"
                                id="description"
                            />
                            <jet-input-error
                                :message="updatedDiscount.errors.description"
                            />
                        </div>
                        <div class="grid gap-2 md:col-span-2">
                            <jet-label
                                >Percentage Discount?<jet-checkbox
                                    v-model="updatedDiscount.is_percentage"
                                    :checked="updatedDiscount.is_percentage"
                                    class="ml-2"
                                    >Percentage</jet-checkbox
                                ></jet-label
                            >

                            <div
                                v-show="updatedDiscount.is_percentage"
                                class="grid gap-2"
                            >
                                <jet-label for="percentage"
                                    >Percentage %</jet-label
                                >
                                <jet-input
                                    type="number"
                                    v-model="
                                        updatedDiscount.discount_percentage
                                    "
                                    id="percentage"
                                />
                                <jet-input-error
                                    v-show="
                                        updatedDiscount.isDirty &&
                                        updatedDiscount.is_percentage
                                    "
                                    message="Make sure to update the discount description if you change this."
                                />
                                <jet-input-error
                                    :message="
                                        updatedDiscount.errors
                                            .discount_percentage
                                    "
                                />
                            </div>
                            <div
                                v-show="!updatedDiscount.is_percentage"
                                class="grid gap-2"
                            >
                                <jet-label for="amount"
                                    >Discount Amount</jet-label
                                >
                                <jet-input
                                    type="number"
                                    v-model.number="
                                        updatedDiscount.discount_amount
                                    "
                                    id="amount"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </template>

            <template #footer>
                <div
                    class="
                        space-y-4
                        sm:space-y-0 sm:flex sm:justify-between
                        items-center
                        w-full
                    "
                >
                    <jet-secondary-button type="button" @click="close"
                        >Cancel</jet-secondary-button
                    >
                    <div class="sm:flex items-center space-y-4 sm:space-y-0">
                        <discount-delete
                            class="sm:mr-2 block"
                            :discount="discount"
                        />
                        <jet-button
                            type="submit"
                            @click="createDiscount"
                            :class="{
                                'opacity-25': updatedDiscount.processing,
                            }"
                            :disabled="updatedDiscount.processing"
                            >Save Discount</jet-button
                        >
                    </div>
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal";
import DiscountDelete from "./DiscountDelete";
export default {
    props: { discount: Object, show: Boolean },
    components: {
        JetDialogModal,
        DiscountDelete,
    },
    data() {
        return {
            editingDiscount: this.show,
            updatedDiscount: this.$inertia.form({
                _method: "POST",
                description: this.discount.description,
                discount_percentage: this.discount.discount_percentage,
                discount_amount: this.discount.discount_amount,
                is_percentage: this.discount.discount_percentage ? true : false,
            }),
        };
    },
    watch: {
        show() {
            this.editingDiscount = this.show;
        },
        "updatedDiscount.is_percentage": function (newVal) {
            if (newVal) {
                this.updatedDiscount.discount_amount = null;
            } else {
                this.updatedDiscount.discount_percentage = null;
            }
        },
    },

    methods: {
        createDiscount() {
            this.updatedDiscount.patch(
                route("orders.discounts.update", [
                    this.discount.order_id,
                    this.discount,
                ]),
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        this.close();
                    },
                }
            );
        },
        close() {
            this.$emit("close");
            this.editingDiscount = false;
        },
    },
};
</script>
