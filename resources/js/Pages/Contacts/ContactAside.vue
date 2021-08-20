<template>
  <div class="my-5 md:mt-0">
    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
      <jet-section-title>
        <template #title>Contacts</template>
        <template v-if="customer.contacts.length" #aside
          ><create-contact-component :customer="customer"
        /></template>
      </jet-section-title>
      <div class="divide-y divide-gray-200 mt-4">
        <update-contact-component
          v-for="contact in customer.contacts"
          :key="contact.id"
          :contact="contact"
        />
        <create-contact-component
          v-if="!customer.contacts.length"
          :customer="customer"
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
  props: { customer: Object },
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
