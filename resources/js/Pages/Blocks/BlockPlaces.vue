<template>
  <details-section>
    <template #header>{{ block.name }} Places</template>
    <div class="grid grid-cols-2 gap-4">
      <div>
        <h3>Rows</h3>
      </div>
      <div>
        <h3>Pots</h3>
      </div>
    </div>
  </details-section>
</template>
<script>
import DetailsSection from "@Components/DetailsSection.vue";
export default {
  components: {
    DetailsSection,
  },
  props: {
    block: Object,
  },
};
</script>