<template>
  <blocks-layout>
    <div class="space-y-6">
      <update-block-form :block="block" />
      <delete-block-form :block="block" />
    </div>
  </blocks-layout>
</template>

<script>
import BlocksLayout from "./BlocksLayout.vue";
import UpdateBlockForm from "./UpdateBlockForm";
import DeleteBlockForm from "./DeleteBlockForm.vue";
export default {
  components: {
    BlocksLayout,
    UpdateBlockForm,
    DeleteBlockForm,
  },
  props: {
    block: Object,
  },
};
</script>
