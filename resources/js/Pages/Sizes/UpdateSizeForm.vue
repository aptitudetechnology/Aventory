<template>
  <td
    class="
      px-6
      bg-white
      rounded-l-lg
      py-4
      whitespace-nowrap
      text-sm
      font-medium
      text-gray-900
    "
  >
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
  </td>
  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    <select-box
      :items="sizes"
      :showLabel="false"
      :selectedItem="selectedSize"
      v-model="selectedSize"
    />
  </td>
</template>
<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import SelectBox from "@Components/SelectBox";

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
    SelectBox,
  },
  props: {
    size: Object,
  },
  data() {
    return {
      sizes: this.$page.props.sizes,
      selectedSize: this.$page.props.sizes.filter(
        (size) => size.id == this.size.next_size_id
      )[0],
      form: this.$inertia.form({
        _method: "POST",
        name: this.size.name,
        next_size_id: this.size.next_size_id,
      }),
    };
  },
  watch: {
    selectedSize(value) {
      this.form.next_size_id = value.id;
      this.updateSize();
    },
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
