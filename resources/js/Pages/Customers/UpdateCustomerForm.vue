<template>
    <jet-form-section @submitted="updateCustomer">
        <template #title>
            {{ customer.name }}
        </template>

        <template #description>
            Update {{ customer.name }} by editing the form fields and clicking
            save.
        </template>

        <template #form>
            <div class="col-span-6">
                <div class="grid gap-4">
                    <div class="col-span-3">
                        <jet-label for="name" value="Customer Name" />
                        <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.name"
                            required
                            autocomplete="organization"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.name"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3">
                        <jet-label for="notes" value="Customer Notes" />
                        <text-area-input
                            id="notes"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.notes"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.notes"
                            class="mt-2"
                        />
                    </div>
                </div>
                <div class="grid gap-4">
                    <div class="col-span-3 pt-6">
                        <h3 class="text-lg leading-6 text-gray-900">
                            Primary Address
                        </h3>
                    </div>
                    <div class="col-span-3">
                        <jet-label for="address" value="Street Address" />
                        <jet-input
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.address"
                            autocomplete="address"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.address"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 md:col-span-1">
                        <jet-label for="city" value="City" />
                        <jet-input
                            id="city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.city"
                            autocomplete="address-level2"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.city"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 md:col-span-1">
                        <jet-label for="state" value="State" />
                        <jet-input
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.state"
                            autocomplete="address-level1"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.state"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 md:col-span-1">
                        <jet-label for="zip" value="Zip" />
                        <jet-input
                            id="zip"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.zip"
                            autocomplete="postal-code"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.zip"
                            class="mt-2"
                        />
                    </div>
                    <SwitchGroup
                        as="div"
                        class="flex items-center justify-between col-span-3"
                    >
                        <span class="flex-grow flex flex-col mr-4">
                            <SwitchLabel as="span" class="text-sm text-gray-900"
                                >Mailing same as primary</SwitchLabel
                            >
                            <SwitchDescription
                                as="span"
                                class="text-sm text-gray-500"
                                >Indicate whether the mailing address of this
                                customer is the same as the primary
                                address.</SwitchDescription
                            >
                        </span>
                        <Switch
                            v-model="updatedCustomer.mailing_same_as_primary"
                            :class="[
                                updatedCustomer.mailing_same_as_primary
                                    ? 'bg-green-600'
                                    : 'bg-gray-200',
                                'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                            ]"
                        >
                            <span
                                aria-hidden="true"
                                :class="[
                                    updatedCustomer.mailing_same_as_primary
                                        ? 'translate-x-5'
                                        : 'translate-x-0',
                                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transupdatedCustomer ring-0 transition ease-in-out duration-200',
                                ]"
                            />
                        </Switch>
                    </SwitchGroup>
                </div>
                <div
                    v-show="!updatedCustomer.mailing_same_as_primary"
                    class="grid gap-4"
                >
                    <div class="col-span-3 pt-6">
                        <h3 class="text-lg leading-6 text-gray-900">
                            Mailing Address
                        </h3>
                    </div>
                    <div class="col-span-3">
                        <jet-label
                            for="mailing_address"
                            value="Mailing Street Address"
                        />
                        <jet-input
                            id="mailing_address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.mailing_address"
                            autocomplete="address"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.mailing_address"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 md:col-span-1">
                        <jet-label for="mailing_city" value="Mailing City" />
                        <jet-input
                            id="mailing_city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.mailing_city"
                            autocomplete="address-level2"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.mailing_city"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 md:col-span-1">
                        <jet-label for="mailing_state" value="Mailing State" />
                        <jet-input
                            id="mailing_state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.mailing_state"
                            autocomplete="address-level1"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.mailing_state"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 md:col-span-1">
                        <jet-label for="mailing_zip" value="Mailing Zip" />
                        <jet-input
                            id="mailing_zip"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="updatedCustomer.mailing_zip"
                            autocomplete="postal-code"
                        />
                        <jet-input-error
                            :message="updatedCustomer.errors.mailing_zip"
                            class="mt-2"
                        />
                    </div>
                </div>
                <div class="grid gap-4">
                    <div class="col-span-3 pt-6">
                        <h3 class="text-lg leading-6 text-gray-900">
                            Customer Details
                        </h3>
                    </div>

                    <div class="grid gap-4 col-span-3">
                        <select-box
                            v-if="priceLevels.length > 0"
                            :items="priceLevels"
                            :selectedItem="price_level"
                            v-model="price_level"
                            labelValue="Customer Price Level"
                        />
                        <jet-input-error
                            :message="
                                updatedCustomer.errors.customer_price_level_id
                            "
                            class="mt-2"
                        />
                        <SwitchGroup
                            as="div"
                            class="flex items-center justify-start col-span-3 sm:col-span-1"
                        >
                            <SwitchLabel
                                as="span"
                                class="text-sm text-gray-900 mr-4"
                                >Taxable?</SwitchLabel
                            >
                            <Switch
                                v-model="updatedCustomer.is_taxable"
                                :class="[
                                    updatedCustomer.is_taxable
                                        ? 'bg-green-600'
                                        : 'bg-gray-200',
                                    'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                                ]"
                            >
                                <span
                                    aria-hidden="true"
                                    :class="[
                                        updatedCustomer.is_taxable
                                            ? 'translate-x-5'
                                            : 'translate-x-0',
                                        'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transupdatedCustomer ring-0 transition ease-in-out duration-200',
                                    ]"
                                />
                            </Switch>
                        </SwitchGroup>
                        <div
                            class="grid gap-4 sm:gap-6 sm:grid-cols-3 col-span-3"
                        >
                            <SwitchGroup
                                v-show="updatedCustomer.is_taxable"
                                as="div"
                                class="flex items-center justify-start sm:col-span-2"
                            >
                                <div class="flex flex-col">
                                    <SwitchLabel
                                        as="span"
                                        class="text-sm font-medium text-gray-900 mr-4"
                                        >Custom Tax Rate?</SwitchLabel
                                    >
                                    <SwitchLabel
                                        as="span"
                                        class="text-sm text-gray-500"
                                        >Indicate whether this customer has a
                                        custom tax rate to be applied to taxable
                                        orders and products.</SwitchLabel
                                    >
                                </div>

                                <Switch
                                    v-model="hasCustomTaxRate"
                                    :class="[
                                        hasCustomTaxRate
                                            ? 'bg-green-600'
                                            : 'bg-gray-200',
                                        'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                                    ]"
                                >
                                    <span
                                        aria-hidden="true"
                                        :class="[
                                            hasCustomTaxRate
                                                ? 'translate-x-5'
                                                : 'translate-x-0',
                                            'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transupdatedCustomer ring-0 transition ease-in-out duration-200',
                                        ]"
                                    />
                                </Switch>
                            </SwitchGroup>
                            <div v-show="hasCustomTaxRate">
                                <jet-label
                                    for="tax_percentage"
                                    value="Customer Tax Rate"
                                />
                                <percentage-input
                                    id="tax_percentage"
                                    max="100.00"
                                    min="0.00"
                                    step=".01"
                                    placeholder="0.00"
                                    v-model="updatedCustomer.tax_percentage"
                                />
                                <jet-input-error
                                    :message="
                                        updatedCustomer.errors.tax_percentage
                                    "
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2 col-span-3">
                        <div class="">
                            <jet-label
                                for="discount_percentage"
                                value="Percentage Discount"
                            />
                            <percentage-input
                                id="discount_percentage"
                                max="100.00"
                                min="0.00"
                                placeholder="0.00"
                                v-model="updatedCustomer.discount_percentage"
                            />
                            <jet-input-error
                                :message="
                                    updatedCustomer.errors.discount_percentage
                                "
                                class="mt-2"
                            />
                        </div>
                        <div class="">
                            <jet-label
                                for="reseller_permit_expiration"
                                value="Reseller Permit Expiration"
                            />
                            <jet-input
                                id="reseller_permit_expiration"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="
                                    updatedCustomer.reseller_permit_expiration
                                "
                            />
                            <jet-input-error
                                :message="
                                    updatedCustomer.errors
                                        .reseller_permit_expiration
                                "
                                class="mt-2"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="[
                    { 'opacity-25': updatedCustomer.processing },
                    { 'opacity-25': !updatedCustomer.isDirty },
                ]"
                :disabled="
                    updatedCustomer.processing || !updatedCustomer.isDirty
                "
                >Save Customer</jet-button
            >
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";
import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        TextAreaInput,
        SelectBox,
    },
    props: ["customer"],

    data() {
        return {
            priceLevels: this.$page.props.priceLevels,
            price_level: this.$page.props.priceLevel,
            updatedCustomer: this.$inertia.form(this.customer),
        };
    },
    computed: {
        hasCustomTaxRate: {
            get() {
                return this.updatedCustomer.tax_percentage !== null;
            },
            set(value) {
                this.updatedCustomer.tax_percentage = value == true ? 8 : null;
            },
        },
    },

    watch: {
        price_level: function () {
            this.price_level
                ? (this.updatedCustomer.customer_price_level_id =
                      this.price_level.id)
                : (this.updatedCustomer.customer_price_level_id = null);
        },
    },

    methods: {
        updateCustomer() {
            this.updatedCustomer.patch(
                route("customers.update", this.customer.id),
                {
                    preserveScroll: false,
                    preserveState: true,
                }
            );
        },
    },
};
</script>
