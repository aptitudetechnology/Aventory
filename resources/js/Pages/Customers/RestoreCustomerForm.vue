<template>
  <jet-action-section>
    <template #title>Restore Customer </template>

    <template #description
      >Restore this customer. You will be able to create new orders and quotes
      with this customer and will no longer be archived.</template
    >

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Once a customer is restored, you will be able to create orders for this
        customer.
      </div>

      <div class="mt-5">
        <jet-button @click="confirmCustomerRestoration">
          Restore Customer
        </jet-button>
      </div>

      <!-- Restore Customer Confirmation Modal -->
      <jet-confirmation-modal
        :show="confirmingCustomerRestoration"
        @close="confirmingCustomerRestoration = false"
      >
        <template #title> Restore Customer </template>

        <template #content>
          Are you sure you want to restore this customer?
        </template>

        <template #footer>
          <jet-secondary-button @click="confirmingCustomerRestoration = false">
            Cancel
          </jet-secondary-button>

          <jet-button
            class="ml-2"
            @click="RestoreCustomer"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Restore Customer
          </jet-button>
        </template>
      </jet-confirmation-modal>
    </template>
  </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
  props: ["customer"],

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingCustomerRestoration: false,
      restoring: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmCustomerRestoration() {
      this.confirmingCustomerRestoration = true;
    },

    RestoreCustomer() {
      this.form.post(route("archived-customers.restore", this.customer.id), {
        errorBag: "restoreCustomer",
      });
    },
  },
};
</script>
