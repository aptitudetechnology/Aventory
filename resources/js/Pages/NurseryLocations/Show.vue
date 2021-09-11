<template>
  <locations-layout>
    <div class="space-y-6">
      <update-location-form :location="location" />
      <delete-location-form :location="location" />
    </div>
  </locations-layout>
</template>

<script>
import LocationsLayout from "./LocationsLayout.vue";
import UpdateLocationForm from "./UpdateLocationForm";
import DeleteLocationForm from "./DeleteLocationForm.vue";
export default {
  components: {
    LocationsLayout,
    UpdateLocationForm,
    DeleteLocationForm,
  },
  props: {
    location: Object,
  },
};
</script>
