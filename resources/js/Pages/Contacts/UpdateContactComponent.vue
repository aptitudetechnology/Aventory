<template>
  <div>
    <div
      @click="updatingContact = true"
      class="
        relative
        py-5
        px-3
        flex
        items-center
        space-x-3
        hover:bg-gray-50
        cursor-pointer
      "
    >
      <div class="flex-1 min-w-0">
        <div class="focus:outline-none">
          <!-- Extend touch target to entire panel -->
          <span class="absolute inset-0" aria-hidden="true" />
          <p class="text-sm font-medium text-gray-900">
            {{ name }}
          </p>
          <p v-if="contact.phone_1" class="text-sm text-gray-500 truncate">
            {{ contact.phone_1 }}
          </p>
        </div>
      </div>
    </div>
    <jet-dialog-modal :show="updatingContact" @close="updatingContact = false">
      <template #title>Update Contact</template>

      <template #aside>
        <delete-contact-component :contact="contact"
      /></template>
      <template #content>
        <form @submit.prevent="updateContact">
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
          <jet-secondary-button type="button" @click="updatingContact = false"
            >Cancel</jet-secondary-button
          >
          <jet-button
            type="submit"
            @click="updateContact"
            :class="{ 'opacity-25': form.processing || !form.isDirty }"
            :disabled="form.processing || !form.isDirty"
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
import DeleteContactComponent from "./DeleteContactComponent.vue";
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
    DeleteContactComponent,
  },
  props: { contact: Object },

  data() {
    return {
      updatingContact: false,
      form: this.$inertia.form({
        _method: "PATCH",
        customer_id: this.contact.customer_id,
        first_name: this.contact.first_name,
        last_name: this.contact.last_name,
        notes: this.contact.notes,
        email: this.contact.email,
        phone_1: this.contact.phone_1,
        phone_2: this.contact.phone_2,
        cell_phone: this.contact.cell_phone,
        fax: this.contact.fax,
      }),
    };
  },
  computed: {
    name() {
      return this.contact.first_name + " " + this.contact.last_name;
    },
  },

  methods: {
    updateContact() {
      this.form.patch(route("contacts.update", this.contact.id), {
        preserveScroll: false,
        preserveState: true,
        onSuccess: () => {
          this.form.reset();
          this.updatingContact = false;
        },
      });
    },
  },
};
</script>
