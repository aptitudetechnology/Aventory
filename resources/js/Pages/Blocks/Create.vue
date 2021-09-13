<template>
  <blocks-layout>
    <create-block-form />
  </blocks-layout>
</template>

<script>
import CreateBlockForm from "./CreateBlockForm";
import BlocksLayout from "./BlocksLayout.vue";
export default {
  components: {
    CreateBlockForm,
    BlocksLayout,
  },
};
</script>
