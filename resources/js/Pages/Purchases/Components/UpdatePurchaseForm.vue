<template>
    <jet-form-section @submitted="updatePurchase">
        <template #title>Update Purchase</template>

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
                            :selectedItem="purchaseVendor"
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
                :class="{ 'opacity-25': form.processing || !form.isDirty }"
                :disabled="form.processing || !form.isDirty"
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
    props: {
        purchase: Object,
    },

    data() {
        return {
            vendors: this.$page.props.vendors,
            purchaseVendor: this.$page.props.vendors.find(
                (vendor) => vendor.id == this.purchase.vendor_id
            ),
            form: this.$inertia.form({
                _method: "PATCH",
                date: this.purchase.date,
                vendor_id: this.purchase.vendor_id,
                order_number: this.purchase.order_number,
                user_id: this.purchase.user_id,
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
        updatePurchase() {
            this.form.patch(route("purchases.update", this.purchase), {
                errorBag: "updatePurchase",
                preserveScroll: true,
            });
        },
    },
};
</script>
