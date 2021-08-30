<template>
  <features-layout>
    <update-feature-form :feature="feature" />
    <delete-feature-form :feature="feature" class="py-6" />
  </features-layout>
</template>

<script>
import FeaturesLayout from "./FeaturesLayout.vue";
import UpdateFeatureForm from "./UpdateFeatureForm.vue";
import DeleteFeatureForm from "./DeleteFeatureForm.vue";
export default {
  components: {
    FeaturesLayout,
    UpdateFeatureForm,
    DeleteFeatureForm,
  },
  props: {
    feature: Object,
  },
};
</script>
