<template>
  <jet-button @click="printTags">Print Tags</jet-button>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    JetButton,
  },
  props: { order_items: Array },

  methods: {
    printTags() {
      window.open(route("print-items-tags", { order_items: this.order_items }));
      setTimeout(() => {
        Inertia.reload();
      }, 3000);
    },
  },
};
</script>
