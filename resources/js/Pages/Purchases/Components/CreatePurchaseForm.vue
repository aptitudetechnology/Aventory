<template>
    <jet-form-section @submitted="createPurchase">
        <template #title>Create a Purchase</template>

        <template #description>
            Create a new purchase to bring into inventory.
        </template>

        <template #form>
            <div class="col-span-6">
                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="col-span-1">
                        <jet-label for="date" value="Purchase Date" />
                        <jet-input
                            id="date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.date"
                            required
                        />
                        <jet-input-error
                            :message="form.errors.date"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-1">
                        <select-box
                            labelValue="Vendor"
                            :items="vendors"
                            v-model="purchaseVendor"
                        />
                        <jet-input-error
                            :message="form.errors.vendor_id"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-1">
                        <jet-label for="order_number" value="Purchase Number" />
                        <jet-input
                            id="order_number"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.order_number"
                        />
                        <jet-input-error
                            :message="form.errors.order_number"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                >Save Purchase</jet-button
            >
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

import SelectBox from "@/Components/Forms/SelectBox.vue";

export default {
    components: {
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        SelectBox,
    },

    data() {
        return {
            vendors: this.$page.props.vendors,
            purchaseVendor: null,
            form: this.$inertia.form({
                _method: "POST",
                date: null,
                vendor_id: null,
                order_number: null,
                user_id: this.$page.props.user.id,
            }),
        };
    },
    watch: {
        purchaseVendor() {
            if (this.purchaseVendor) {
                this.form.vendor_id = this.purchaseVendor.id;
            } else {
                this.form.vendor_id = null;
            }
        },
    },

    methods: {
        createPurchase() {
            this.form.post(route("purchases.store"), {
                errorBag: "createPurchase",
                preserveScroll: true,
            });
        },
    },
};
</script>
