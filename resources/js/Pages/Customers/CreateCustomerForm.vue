<template>
  <jet-form-section @submitted="createCustomer">
    <template #title>Create a Customer</template>

    <template #description>
      Create a new customer to make orders and quotes to.
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
              v-model="form.name"
              required
              autocomplete="organization"
            />
            <jet-input-error :message="form.errors.name" class="mt-2" />
          </div>
          <div class="col-span-3">
            <jet-label for="notes" value="Customer Notes" />
            <text-area-input
              id="notes"
              class="mt-1 block w-full"
              v-model="form.notes"
            />
            <jet-input-error :message="form.errors.notes" class="mt-2" />
          </div>
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
            <jet-input-error :message="form.errors.address" class="mt-2" />
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
            <jet-input-error :message="form.errors.city" class="mt-2" />
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
            <jet-input-error :message="form.errors.state" class="mt-2" />
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
            <jet-input-error :message="form.errors.zip" class="mt-2" />
          </div>
          <SwitchGroup
            as="div"
            class="flex items-center justify-between col-span-3"
          >
            <span class="flex-grow flex flex-col">
              <SwitchLabel as="span" class="text-sm font-medium text-gray-900"
                >Mailing same as primary</SwitchLabel
              >
              <SwitchDescription as="span" class="text-sm text-gray-500"
                >Indicate whether the mailing address of this customer is the
                same as the primary address.</SwitchDescription
              >
            </span>
            <Switch
              v-model="form.mailing_same_as_primary"
              :class="[
                form.mailing_same_as_primary ? 'bg-indigo-600' : 'bg-gray-200',
                'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
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
            <jet-label for="mailing_address" value="Mailing Street Address" />
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
              id="city"
              type="text"
              class="mt-1 block w-full"
              v-model="form.mailing_city"
              autocomplete="address-level2"
            />
            <jet-input-error :message="form.errors.mailing_city" class="mt-2" />
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
            <jet-input-error :message="form.errors.mailing_zip" class="mt-2" />
          </div>
        </div>
        <div class="grid gap-4">
          <div class="col-span-3 pt-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Customer Details
            </h3>
          </div>

          <div class="grid gap-4 col-span-3">
            <SwitchGroup
              as="div"
              class="flex items-center justify-start col-span-3 sm:col-span-1"
            >
              <SwitchLabel
                as="span"
                class="text-sm font-medium text-gray-900 mr-4"
                >No Auto Discount</SwitchLabel
              >
              <Switch
                v-model="form.no_auto_discount"
                :class="[
                  form.no_auto_discount ? 'bg-indigo-600' : 'bg-gray-200',
                  'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                ]"
              >
                <span
                  aria-hidden="true"
                  :class="[
                    form.no_auto_discount ? 'translate-x-5' : 'translate-x-0',
                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                  ]"
                />
              </Switch>
            </SwitchGroup>
            <SwitchGroup
              as="div"
              class="flex items-center justify-start col-span-3 sm:col-span-1"
            >
              <SwitchLabel
                as="span"
                class="text-sm font-medium text-gray-900 mr-4"
                >Retail Customer?</SwitchLabel
              >
              <Switch
                v-model="form.is_retail"
                :class="[
                  form.is_retail ? 'bg-indigo-600' : 'bg-gray-200',
                  'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500',
                ]"
              >
                <span
                  aria-hidden="true"
                  :class="[
                    form.is_retail ? 'translate-x-5' : 'translate-x-0',
                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                  ]"
                />
              </Switch>
            </SwitchGroup>
          </div>

          <div class="col-span-3 sm:col-span-1">
            <jet-label for="tax_percentage" value="Tax Rate (Override)" />
            <div class="relative">
              <jet-input
                id="tax_percentage"
                type="number"
                max="100.00"
                min="0.00"
                step=".01"
                placeholder="0.00"
                class="mt-1 block w-full"
                v-model="form.tax_percentage"
              />
              <div
                class="
                  absolute
                  inset-y-0
                  right-0
                  pr-3
                  flex
                  items-center
                  pointer-events-none
                "
              >
                <span class="text-gray-500 sm:text-sm"> % </span>
              </div>
            </div>
            <jet-input-error
              :message="form.errors.tax_percentage"
              class="mt-2"
            />
          </div>
          <div class="col-span-3 sm:col-span-1">
            <jet-label for="discount_override" value="Discount % (Override)" />
            <div class="relative">
              <jet-input
                id="discount_override"
                type="number"
                max="100"
                min="0"
                placeholder="0"
                class="mt-1 block w-full"
                v-model="form.discount_override"
              />
              <div
                class="
                  absolute
                  inset-y-0
                  right-0
                  pr-3
                  flex
                  items-center
                  pointer-events-none
                "
              >
                <span class="text-gray-500 sm:text-sm"> % </span>
              </div>
            </div>
            <jet-input-error
              :message="form.errors.discount_override"
              class="mt-2"
            />
          </div>
          <div class="col-span-3 sm:col-span-1">
            <jet-label
              for="reseller_permit_expiration"
              value="Reseller Permit Expiration"
            />
            <jet-input
              id="reseller_permit_expiration"
              type="date"
              class="mt-1 block w-full"
              v-model="form.reseller_permit_expiration"
            />
            <jet-input-error
              :message="form.errors.reseller_permit_expiration"
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
        >Save Customer</jet-button
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
import TextAreaInput from "../../Components/TextAreaInput.vue";

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
  },

  data() {
    return {
      form: this.$inertia.form({
        _method: "POST",
        name: "",
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
        is_retail: false,
        no_auto_discount: false,
        tax_percentage: null,
        discount_override: 0,
        reseller_permit_expiration: null,
      }),
    };
  },

  methods: {
    createCustomer() {
      this.form.post(route("customers.store"), {
        errorBag: "createCustomer",
        preserveScroll: true,
      });
    },
    resellerOnFile() {},
  },
};
</script>