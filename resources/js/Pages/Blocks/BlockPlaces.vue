<template>
  <details-section>
    <template #title>{{ block.name }} Places </template>
    <template #aside
      ><create-places-form :block="block"></create-places-form
    ></template>
    <div v-if="places.length" class="col-span-6">
      <div class="grid grid-cols-2 gap-2 py-2 border-b border-gray-50">
        <h3 class="px-2">Row Number</h3>

        <h3 class="px-2">Plant Place</h3>
      </div>
      <div class="grid grid-cols-2 gap-4 col-span-6">
        <div>
          <div class="max-h-96 overflow-auto">
            <div
              @click="selectedRow = row"
              v-for="row in rows"
              :key="row"
              :class="[
                'p-2 hover:bg-gray-50 cursor-pointer  rounded',
                selectedRow == row ? 'bg-gray-50' : '',
              ]"
            >
              {{ row }}
            </div>
          </div>
        </div>
        <div>
          <div class="max-h-96 overflow-auto">
            <div v-for="plant in plants" :key="plant.id" class="p-2">
              {{ plant.plant_number }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </details-section>
</template>
<script>
import DetailsSection from "@Components/DetailsSection.vue";
import CreatePlacesForm from "./CreatePlacesForm.vue";
export default {
  components: {
    DetailsSection,
    CreatePlacesForm,
  },
  props: {
    block: Object,
  },
  data() {
    return {
      places: this.$page.props.places,
      selectedRow: this.$page.props.places.length
        ? this.$page.props.places[0].row_number
        : null,
    };
  },
  computed: {
    plants() {
      if (this.places.length) {
        return this.places.filter(
          (place) => place.row_number == this.selectedRow
        );
      }
    },
    rows() {
      if (this.places.length) {
        const rows = this.places.map((place) => place.row_number);
        const distinctRows = [...new Set(rows)];
        return distinctRows;
      }
    },
  },
};
</script>