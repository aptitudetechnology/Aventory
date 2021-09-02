<template>
  <svg
    @click="confirmSizeDeletion"
    class="w-6 h-6 mx-auto cursor-pointer"
    fill="none"
    stroke="currentColor"
    viewBox="0 0 24 24"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
    ></path>
  </svg>

  <!-- Delete Size Confirmation Modal -->
  <jet-confirmation-modal
    :show="confirmingSizeDeletion"
    @close="confirmingSizeDeletion = false"
  >
    <template #title> Delete Size </template>

    <template #content>
      Are you sure you want to delete this size? All products in inventory with
      this size will be given a null size and all product pricing with this size
      will be deleted.
    </template>

    <template #footer>
      <jet-secondary-button @click="confirmingSizeDeletion = false">
        Cancel
      </jet-secondary-button>

      <jet-danger-button
        class="ml-2"
        @click="deleteSize"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Delete Size
      </jet-danger-button>
    </template>
  </jet-confirmation-modal>
</template>

<script>
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  props: ["size"],

  components: {
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingSizeDeletion: false,
      deleting: false,

      form: this.$inertia.form(),
    };
  },

  methods: {
    confirmSizeDeletion() {
      this.confirmingSizeDeletion = true;
    },

    deleteSize() {
      this.form.delete(route("sizes.destroy", this.size), {
        errorBag: "deleteSize",
        preserveState: false,
      });
    },
  },
};
</script>
