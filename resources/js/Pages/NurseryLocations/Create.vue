<template>
    <locations-layout>
        <create-location-form />
    </locations-layout>
</template>

<script>
import CreateLocationForm from "./CreateLocationForm.vue";
import LocationsLayout from "./LocationsLayout.vue";
export default {
    components: {
        CreateLocationForm,
        LocationsLayout,
    },
};
</script>
