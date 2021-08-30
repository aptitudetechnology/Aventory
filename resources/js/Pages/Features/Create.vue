<template>
  <features-layout>
    <create-feature-form></create-feature-form>
  </features-layout>
</template>

<script>
import FeaturesLayout from "./FeaturesLayout.vue";
import CreateFeatureForm from "./CreateFeatureForm.vue";
export default {
  components: {
    FeaturesLayout,
    CreateFeatureForm,
  },
};
</script>
