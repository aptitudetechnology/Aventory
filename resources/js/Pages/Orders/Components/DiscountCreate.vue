<template>
    <div>
        <jet-button
            type="button"
            class="btn-warning"
            @click="creatingDiscount = true"
            ><PlusIcon class="w-4 h-4 mr-2" />New Discount</jet-button
        >
        <jet-dialog-modal
            maxWidth="3xl"
            :show="creatingDiscount"
            @close="creatingDiscount = false"
        >
            <template #title
                >Add a discount to apply to this {{ order.type }}.</template
            >

            <template #content>
                <div class="grid grid-cols-6 gap-4">
                    <form
                        @submit.prevent="createDiscount"
                        @keydown.enter="createDiscount"
                        class="col-span-6 grid gap-4 grid-cols-5 items-start"
                    >
                        <div class="grid gap-2 col-span-3">
                            <jet-label for="description"
                                >Discount Description</jet-label
                            >
                            <text-area-input
                                required
                                v-model="discount.description"
                                id="description"
                            />
                            <jet-input-error
                                :message="discount.errors.description"
                            />
                        </div>
                        <div class="grid gap-2 col-span-2">
                            <jet-label
                                >Percentage Discount?<jet-checkbox
                                    v-model="discount.is_percentage"
                                    class="ml-2"
                                    >Percentage</jet-checkbox
                                ></jet-label
                            >

                            <div
                                v-show="discount.is_percentage"
                                class="grid gap-2"
                            >
                                <jet-label for="percentage"
                                    >Percentage %</jet-label
                                >
                                <percentage-input
                                    id="percentage"
                                    v-model="discount.discount_percentage"
                                />
                            </div>
                            <div
                                v-show="!discount.is_percentage"
                                class="grid gap-2"
                            >
                                <jet-label for="amount"
                                    >Discount Amount</jet-label
                                >
                                <money-input
                                    id="amount"
                                    v-model="discount.discount_amount"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </template>

            <template #footer>
                <div class="flex justify-between items-center w-full">
                    <jet-secondary-button
                        type="button"
                        @click="creatingDiscount = false"
                        >Cancel</jet-secondary-button
                    >
                    <div>
                        <jet-button
                            type="submit"
                            @click="createDiscount"
                            :class="{ 'opacity-25': discount.processing }"
                            :disabled="discount.processing"
                            >Save Discount</jet-button
                        >
                    </div>
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import { PlusIcon } from "@heroicons/vue/outline";

export default {
    props: { order: Object },
    components: {
        JetDialogModal,
        PlusIcon,
    },
    data() {
        return {
            creatingDiscount: false,
            discount: this.$inertia.form({
                _method: "POST",
                description: null,
                discount_percentage: null,
                discount_amount: null,
                is_percentage: false,
            }),
        };
    },
    watch: {
        "discount.is_percentage": function (newVal) {
            if (newVal) {
                this.discount.discount_amount = null;
            } else {
                this.discount.discount_percentage = null;
            }
        },
    },

    methods: {
        createDiscount() {
            this.discount.post(route("sales.discounts.store", this.order), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    this.$emit("discount-created", this.discount);
                    this.creatingDiscount = false;
                    this.discount.reset();
                },
            });
        },
    },
};
</script>
