<template>
  <div class="md:grid md:gap-6">
    <div class="md:mt-0 md:col-span-2">
      <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
        <jet-section-title>
          <template #title><slot name="title"></slot></template>
          <template #description><slot name="description"></slot></template>

          <template #aside><slot name="aside"></slot></template>
        </jet-section-title>
        <slot name="content"></slot>
      </div>
    </div>
  </div>
</template>

<script>
import JetSectionTitle from "./SectionTitle";

export default {
  components: {
    JetSectionTitle,
  },
};
</script>
