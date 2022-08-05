<template>
  <jet-action-section>
    <template #title> Delete Customer </template>

    <template #description> Delete this customer. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a customer is deleted, you will be unable to create orders for this
        customer. Past orders will still be displayed for the customer.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmCustomerDeletion">
          Delete Customer
        </jet-danger-button>
      </div>

      <!-- Delete Customer Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingCustomerDeletion"
        @close="confirmingCustomerDeletion = false"
      >
        <template #title> Delete Customer </template>

        <template #content>
          Are you sure you want to delete this customer?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingCustomerDeletion = false">
            Cancel
          </jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteCustomer"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Customer
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
  props: ["customer"],

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingCustomerDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmCustomerDeletion() {
      this.confirmingCustomerDeletion = true;
    },

    deleteCustomer() {
      this.form.delete(route("customers.destroy", this.customer), {
        errorBag: "deleteCustomer",
      });
    },
  },
};
</script>
