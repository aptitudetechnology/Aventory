<template>
  <div>
    <div class="col-span-3">
      <jet-label class="sr-only" for="name" value="Size Name" />
      <jet-input
        @change="updateSize"
        id="name"
        type="text"
        class="mt-1 block w-full"
        v-model="form.name"
        required
        autocomplete="off"
      />
      <jet-input-error :message="form.errors.name" class="mt-2" />
    </div>
  </div>
</template>
<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
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
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    TextAreaInput,
  },
  props: {
    size: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        _method: "POST",
        name: this.size.name,
      }),
    };
  },

  methods: {
    updateSize() {
      this.form.patch(route("sizes.update", this.size), {
        errorBag: "updateSize",
        preserveScroll: true,
      });
    },
  },
};
</script>
