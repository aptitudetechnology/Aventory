<template>
  <div>
    <jet-button @click="creatingPlaces = true"
      >Edit {{ row_number }}</jet-button
    >
    <jet-dialog-modal :show="creatingPlaces" @close="creatingPlaces = false">
      <template #title>Edit Row</template>

      <template #description> Edit the number of places in this row. </template>

      <template #content>
        <form @submit.prevent="updateRow" @keyup.enter="updateRow">
          <div class="col-span-6">
            <div class="grid gap-4 grid-cols-4">
              <div class="col-span-4 sm:col-span-2">
                <div>
                  <jet-label for="row_number" value="Row Number" />
                  <jet-input
                    id="row_number"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.row_number"
                    required
                    disabled
                    autocomplete="off"
                  />
                  <jet-input-error
                    :message="form.errors.row_number"
                    class="mt-2"
                  />
                </div>
              </div>
              <div class="col-span-4 sm:col-span-2">
                <jet-label for="num_places" value="Number of Places" />
                <jet-input
                  id="num_places"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="form.num_places"
                  autocomplete="off"
                />
                <jet-input-error
                  :message="form.errors.num_places"
                  class="mt-2"
                />
              </div>
            </div>
          </div>
        </form>
      </template>

      <template #footer>
        <div class="flex justify-between w-full">
          <jet-secondary-button type="button" @click="creatingPlaces = false"
            >Cancel</jet-secondary-button
          >
          <jet-button
            type="submit"
            @click="updateRow"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            >Save Row</jet-button
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
import TextAreaInput from "@Components/TextAreaInput.vue";

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
  props: { block: Object, row_number: Number, num_plants: Number },

  data() {
    return {
      creatingPlaces: false,
      form: this.$inertia.form({
        _method: "PATCH",
        block_id: this.block.id,
        row_number: this.row_number,
        num_places: this.num_plants,
      }),
    };
  },
  watch: {
    row_number(value) {
      this.form.row_number = value;
      this.form.num_places = this.num_plants;
    },
    num_plants(value) {
      this.form.num_places = value;
    },
  },

  methods: {
    updateRow() {
      this.form.post(route("places.update"), {
        preserveScroll: true,
        preserveState: false,
      });
    },
  },
};
</script>
