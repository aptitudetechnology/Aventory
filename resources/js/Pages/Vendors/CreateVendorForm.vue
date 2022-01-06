<template>
    <jet-form-section @submitted="createVendor">
        <template #title>Create a Vendor</template>

        <template #description>
            Create a new vendor to purchase products from.
        </template>

        <template #form>
            <div class="col-span-6">
                <div class="grid gap-4">
                    <div class="col-span-3">
                        <jet-label for="name" value="Vendor Name" />
                        <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autocomplete="organization"
                        />
                        <jet-input-error
                            :message="form.errors.name"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3">
                        <jet-label for="notes" value="Vendor Notes" />
                        <text-area-input
                            id="notes"
                            class="mt-1 block w-full"
                            v-model="form.notes"
                        />
                        <jet-input-error
                            :message="form.errors.notes"
                            class="mt-2"
                        />
                    </div>

                    <SwitchGroup
                        as="div"
                        class="flex items-center justify-between col-span-3"
                    >
                        <span class="flex-grow flex flex-col">
                            <SwitchLabel
                                as="span"
                                class="text-sm font-medium text-gray-900"
                                >Use vendor for block inventory
                                transfers?</SwitchLabel
                            >
                            <SwitchDescription
                                as="span"
                                class="text-sm text-gray-500"
                                >Indicate whether this vendor will be used for
                                transfers from the block
                                inventory.</SwitchDescription
                            >
                        </span>
                        <Switch
                            v-model="form.use_for_block_transfers"
                            :class="[
                                form.use_for_block_transfers
                                    ? 'bg-green-600'
                                    : 'bg-gray-200',
                                'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                            ]"
                        >
                            <span
                                aria-hidden="true"
                                :class="[
                                    form.use_for_block_transfers
                                        ? 'translate-x-5'
                                        : 'translate-x-0',
                                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                ]"
                            />
                        </Switch>
                    </SwitchGroup>
                </div>
                <div class="grid gap-4">
                    <div class="col-span-3 pt-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Primary Address
                        </h3>
                    </div>
                    <div class="col-span-3">
                        <jet-label for="address" value="Street Address" />
                        <jet-input
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            autocomplete="address"
                        />
                        <jet-input-error
                            :message="form.errors.address"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="city" value="City" />
                        <jet-input
                            id="city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.city"
                            autocomplete="address-level2"
                        />
                        <jet-input-error
                            :message="form.errors.city"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="state" value="State" />
                        <jet-input
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.state"
                            autocomplete="address-level1"
                        />
                        <jet-input-error
                            :message="form.errors.state"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="zip" value="Zip" />
                        <jet-input
                            id="zip"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.zip"
                            autocomplete="postal-code"
                        />
                        <jet-input-error
                            :message="form.errors.zip"
                            class="mt-2"
                        />
                    </div>
                    <SwitchGroup
                        as="div"
                        class="flex items-center justify-between col-span-3"
                    >
                        <span class="flex-grow flex flex-col">
                            <SwitchLabel
                                as="span"
                                class="text-sm font-medium text-gray-900"
                                >Mailing same as primary</SwitchLabel
                            >
                            <SwitchDescription
                                as="span"
                                class="text-sm text-gray-500"
                                >Indicate whether the mailing address of this
                                vendor is the same as the primary
                                address.</SwitchDescription
                            >
                        </span>
                        <Switch
                            v-model="form.mailing_same_as_primary"
                            :class="[
                                form.mailing_same_as_primary
                                    ? 'bg-green-600'
                                    : 'bg-gray-200',
                                'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                            ]"
                        >
                            <span
                                aria-hidden="true"
                                :class="[
                                    form.mailing_same_as_primary
                                        ? 'translate-x-5'
                                        : 'translate-x-0',
                                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                ]"
                            />
                        </Switch>
                    </SwitchGroup>
                </div>
                <div v-if="!form.mailing_same_as_primary" class="grid gap-4">
                    <div class="col-span-3 pt-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
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
                            v-model="form.mailing_address"
                            autocomplete="address"
                        />
                        <jet-input-error
                            :message="form.errors.mailing_address"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="mailing_city" value="Mailing City" />
                        <jet-input
                            id="mailing_city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.mailing_city"
                            autocomplete="address-level2"
                        />
                        <jet-input-error
                            :message="form.errors.mailing_city"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="mailing_state" value="Mailing State" />
                        <jet-input
                            id="mailing_state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.mailing_state"
                            autocomplete="address-level1"
                        />
                        <jet-input-error
                            :message="form.errors.mailing_state"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="mailing_zip" value="Mailing Zip" />
                        <jet-input
                            id="mailing_zip"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.mailing_zip"
                            autocomplete="postal-code"
                        />
                        <jet-input-error
                            :message="form.errors.mailing_zip"
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
                >Save Vendor</jet-button
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
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
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

    data() {
        return {
            form: this.$inertia.form({
                _method: "POST",
                name: "",
                vendor_code: "",
                address: "",
                city: "",
                state: "",
                zip: "",
                mailing_same_as_primary: true,
                mailing_address: "",
                mailing_city: "",
                mailing_state: "",
                mailing_zip: "",
                notes: "",
                use_for_block_transfers: false,
            }),
        };
    },

    methods: {
        createVendor() {
            this.form.post(route("vendors.store"), {
                errorBag: "createVendor",
                preserveScroll: true,
            });
        },
    },
};
</script>
