<template>
  <div>
    <jet-danger-button @click="confirmContactDeletion">
      Delete
    </jet-danger-button>

    <!-- Delete contact Confirmation Modal -->
    <jet-confirmation-modal
      :show="confirmingContactDeletion"
      @close="confirmingContactDeletion = false"
    >
      <template #title> Delete Contact </template>

      <template #content>
        Are you sure you want to delete {{ contact.first_name }}?
      </template>

      <template #footer>
        <jet-secondary-button @click="confirmingContactDeletion = false">
          Cancel
        </jet-secondary-button>

        <jet-danger-button
          class="ml-2"
          @click="deleteContact"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Delete Contact
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>
  </div>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  props: ["contact"],

  components: {
    JetActionSection,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingContactDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmContactDeletion() {
      this.confirmingContactDeletion = true;
    },

    deleteContact() {
      this.form.delete(route("contacts.destroy", this.contact), {
        errorBag: "deleteContact",
      });
    },
  },
};
</script>
