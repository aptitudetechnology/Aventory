<template>
  <div>
    <jet-button @click="creatingContact = true">New Contact</jet-button>
    <jet-dialog-modal :show="creatingContact" @close="creatingContact = false">
      <template #title>Create a Contact</template>

      <template #description>
        Create a new contact to track who you do business with.
      </template>

      <template #content>
        <form @submit.prevent="createContact" @keyup.enter="createContact">
          <div class="col-span-6">
            <div class="grid gap-4">
              <div class="col-span-4 sm:col-span-2">
                <jet-label for="first_name" value="First Name" />
                <jet-input
                  id="first_name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.first_name"
                  required
                  autocomplete="given-name"
                />
                <jet-input-error
                  :message="form.errors.first_name"
                  class="mt-2"
                />
              </div>
              <div class="col-span-4 sm:col-span-2">
                <jet-label for="last_name" value="Last Name" />
                <jet-input
                  id="last_name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.last_name"
                  autocomplete="family-name"
                />
                <jet-input-error
                  :message="form.errors.last_name"
                  class="mt-2"
                />
              </div>
              <div class="col-span-4">
                <jet-label for="notes" value="Contact Notes" />
                <text-area-input
                  id="notes"
                  class="mt-1 block w-full"
                  v-model="form.notes"
                />
                <jet-input-error :message="form.errors.notes" class="mt-2" />
              </div>
            </div>
            <div class="grid gap-4">
              <div class="col-span-4 pt-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Contact Details
                </h3>
              </div>
              <div class="col-span-4">
                <jet-label for="email" value="Email Address" />
                <jet-input
                  id="email"
                  type="email"
                  class="mt-1 block w-full"
                  v-model="form.email"
                  autocomplete="email"
                />
                <jet-input-error :message="form.errors.email" class="mt-2" />
              </div>
              <div class="col-span-4 sm:col-span-2">
                <jet-label for="phone_1" value="Primary Phone" />
                <jet-input
                  id="phone_1"
                  type="tel"
                  class="mt-1 block w-full"
                  v-model="form.phone_1"
                  autocomplete="tel"
                />
                <jet-input-error :message="form.errors.phone_1" class="mt-2" />
              </div>
              <div class="col-span-4 sm:col-span-2">
                <jet-label for="phone_2" value="Secondary Phone" />
                <jet-input
                  id="phone_2"
                  type="tel"
                  class="mt-1 block w-full"
                  v-model="form.phone_2"
                  autocomplete="tel"
                />
                <jet-input-error :message="form.errors.phone_2" class="mt-2" />
              </div>
              <div class="col-span-4 sm:col-span-2">
                <jet-label for="cell_phone" value="Cell Phone" />
                <jet-input
                  id="cell_phone"
                  type="tel"
                  class="mt-1 block w-full"
                  v-model="form.cell_phone"
                  autocomplete="tel"
                />
                <jet-input-error
                  :message="form.errors.cell_phone"
                  class="mt-2"
                />
              </div>
              <div class="col-span-4 sm:col-span-2">
                <jet-label for="fax" value="Fax" />
                <jet-input
                  id="fax"
                  type="tel"
                  class="mt-1 block w-full"
                  v-model="form.fax"
                  autocomplete="tel"
                />
                <jet-input-error :message="form.errors.fax" class="mt-2" />
              </div>
            </div>
          </div>
        </form>
      </template>

      <template #footer>
        <div class="flex justify-between w-full">
          <jet-secondary-button type="button" @click="creatingContact = false"
            >Cancel</jet-secondary-button
          >
          <jet-button
            type="submit"
            @click="createContact"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            >Save Contact</jet-button
          >
        </div>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import TextAreaInput from "../../Components/TextAreaInput.vue";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    TextAreaInput,
  },
  props: { customer: Object, vendor: Object },

  data() {
    return {
      creatingContact: false,
      form: this.$inertia.form({
        _method: "POST",
        customer_id: this.customer ? this.customer.id : null,
        vendor_id: this.vendor ? this.vendor.id : null,
        first_name: "",
        last_name: null,
        notes: null,
        email: null,
        phone_1: null,
        phone_2: null,
        cell_phone: null,
        fax: null,
      }),
    };
  },

  methods: {
    createContact() {
      this.form.post(route("contacts.store"), {
        preserveScroll: false,
        preserveState: true,
        onSuccess: () => {
          this.form.reset();
          this.creatingContact = false;
        },
      });
    },
  },
};
</script>
