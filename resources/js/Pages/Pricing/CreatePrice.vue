<template>
    <div>
        <jet-button @click="creatingProductPrice = true"
            >New Size & Price</jet-button
        >
        <jet-dialog-modal
            :show="creatingProductPrice"
            @close="creatingProductPrice = false"
        >
            <template #title>Create a Size and Price</template>

            <template #description>
                Add a size for this product, and give it a base price.
            </template>

            <template #content>
                <form @submit.prevent="createPrice">
                    <div class="col-span-6">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <select-box
                                    labelValue="Product Size"
                                    :items="sizes"
                                    v-model="selectedSize"
                                />
                                <jet-input-error
                                    :message="form.errors.size_id"
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
                                    :message="form.errors.unit_price"
                                    class="mt-2"
                                />
                            </div>
                            <SwitchGroup
                                as="div"
                                class="
                                    flex
                                    items-center
                                    justify-between
                                    sm:col-span-3
                                "
                            >
                                <span class="flex-grow flex flex-col">
                                    <SwitchLabel
                                        as="span"
                                        class="
                                            text-sm
                                            font-medium
                                            text-gray-900
                                        "
                                        >Show this product size and price on the
                                        availability?</SwitchLabel
                                    >
                                    <SwitchDescription
                                        as="span"
                                        class="text-sm text-gray-500"
                                        >You can uncheck this to make sure this
                                        price and size will not be displayed in
                                        availability lists. Inventory value
                                        reports will still contain this product
                                        and size if in
                                        inventory.</SwitchDescription
                                    >
                                </span>
                                <Switch
                                    v-model="form.show_on_availability"
                                    :class="[
                                        form.show_on_availability
                                            ? 'bg-green-600'
                                            : 'bg-gray-200',
                                        'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                                    ]"
                                >
                                    <span
                                        aria-hidden="true"
                                        :class="[
                                            form.show_on_availability
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
                        @click="creatingProductPrice = false"
                        >Cancel</jet-secondary-button
                    >
                    <jet-button
                        type="submit"
                        @click="createPrice"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        >Save Price</jet-button
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
    },
    props: { product: Object, category: Object },

    data() {
        return {
            sizes: this.$page.props.sizes,
            selectedSize: null,
            creatingProductPrice: false,
            form: this.$inertia.form({
                _method: "POST",
                product_id: this.product ? this.product.id : null,
                category_id: this.category ? this.category.id : null,
                size_id: null,
                unit_price: null,
                show_on_availability: true,
            }),
        };
    },
    watch: {
        selectedSize() {
            if (this.selectedSize) {
                this.form.size_id = this.selectedSize.id;
            }
        },
    },

    methods: {
        createPrice() {
            this.form.post(route("prices.store"), {
                preserveScroll: false,
                preserveState: true,
                onSuccess: () => {
                    this.form.reset();
                    this.selectedSize = null;
                    this.creatingProductPrice = false;
                },
            });
        },
    },
};
</script>
