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
      tags: null,
      form: this.$inertia.form({
        _method: "POST",
        order_items: this.selectedItems,
      }),
    };
  },

  methods: {
    printTags() {
      axios.post(route("print-items-tags"), this.form).then((response) => {});
    },
  },
};
</script>
