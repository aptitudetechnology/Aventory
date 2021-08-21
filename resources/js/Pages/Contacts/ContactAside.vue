<template>
  <div class="my-5 md:mt-0">
    <div class="py-5 bg-white shadow sm:rounded-lg overflow-hidden">
      <div class="px-4 sm:px-6">
        <jet-section-title>
          <template #title>Contacts</template>
          <template
            v-if="
              (customer && customer.contacts.length) ||
              (vendor && vendor.contacts.length)
            "
            #aside
            ><create-contact-component :customer="customer" :vendor="vendor"
          /></template>
        </jet-section-title>
      </div>

      <div v-if="customer" class="divide-y divide-gray-200 mt-4">
        <update-contact-component
          v-for="contact in customer.contacts"
          :key="contact.id"
          :contact="contact"
        />
        <create-contact-component
          class="px-4 sm:px-6"
          v-if="!customer.contacts.length"
          :customer="customer"
        />
      </div>
      <div v-if="vendor" class="divide-y divide-gray-200 mt-4">
        <update-contact-component
          v-for="contact in vendor.contacts"
          :key="contact.id"
          :contact="contact"
        />
        <create-contact-component
          class="px-4 sm:px-6"
          v-if="!vendor.contacts.length"
          :vendor="vendor"
        />
      </div>
    </div>
  </div>
</template>
<script>
import JetSectionTitle from "../../Jetstream/SectionTitle.vue";
import CreateContactComponent from "./CreateContactComponent.vue";
import JetDialogModel from "../../Jetstream/DialogModal.vue";
import UpdateContactComponent from "./UpdateContactComponent.vue";
export default {
  props: { customer: Object, vendor: Object },
  components: {
    JetSectionTitle,
    CreateContactComponent,
    JetDialogModel,
    UpdateContactComponent,
  },
  data() {
    return {
      creatingCustomer: true,
    };
  },
};
</script>
