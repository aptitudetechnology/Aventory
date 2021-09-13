<template>
  <locations-layout>
    <div class="space-y-6">
      <LocationDetails :location="location" />
    </div>
  </locations-layout>
</template>

<script>
import LocationsLayout from "./LocationsLayout.vue";
import LocationDetails from "./LocationDetails.vue";
export default {
  components: {
    LocationsLayout,
    LocationDetails,
  },
  props: {
    location: Object,
  },
};
</script>
