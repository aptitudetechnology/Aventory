<template>
  <jet-button @click="printTags">Print Tags</jet-button>
</template>

<script>
import JetButton from "@/Jetstream/Button";

export default {
  components: {
    JetButton,
  },
  props: { selectedItems: Array },

  data() {
    return {
      form: this.$inertia.form({
        _method: "POST",
        order_items: this.selectedItems,
      }),
    };
  },

  methods: {
    printTags() {
      this.form.post(route("print-items-tags"), {
        preserveState: false,
      });
    },
  },
};
</script>
