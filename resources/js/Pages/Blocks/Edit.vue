<template>
  <blocks-layout>
    <div class="space-y-6">
      <update-block-form :block="block" />
      <block-places v-if="block.has_places" :block="block" />
      <delete-block-form :block="block" />
    </div>
  </blocks-layout>
</template>

<script>
import BlocksLayout from "./BlocksLayout.vue";
import UpdateBlockForm from "./UpdateBlockForm";
import DeleteBlockForm from "./DeleteBlockForm.vue";
import BlockPlaces from "./Places/BlockPlaces.vue";
export default {
  components: {
    BlocksLayout,
    UpdateBlockForm,
    DeleteBlockForm,
    BlockPlaces,
  },
  props: {
    block: Object,
  },
};
</script>
