<template>
  <blocks-layout>
    <create-block-form class="max-w-screen-md" />
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
