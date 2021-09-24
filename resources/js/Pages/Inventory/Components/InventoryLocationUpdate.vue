<template>
  <div class="py-4 grid gap-4">
    <div class="flex flex-wrap items-center justify-between">
      <h2 class="text-xl">Inventory Location</h2>
      <jet-button @click="editingInventoryLocation = true" class="ml-auto pl-2"
        ><EditIcon class="w-4 h-4 mr-2"></EditIcon> Edit</jet-button
      >
    </div>

    <p v-if="inventory.block">Block: {{ inventory.block.name }}</p>
    <div
      v-if="inventory.place"
      class="flex items-center justify-between space-x-2"
    >
      <p>
        Place: Row number: {{ inventory.place.row_number }} Plant Number:
        {{ inventory.place.plant_number }}
      </p>
      <jet-button v-if="nextLocation" @click="assignNextPlace"
        >Next Row:{{ nextLocation.row_number }} Plant:
        {{ nextLocation.plant_number }}</jet-button
      >
    </div>

    <p v-else class="color-red-500">Place Unasigned</p>

    <jet-dialog-modal
      :show="editingInventoryLocation"
      @close="editingInventoryLocation = false"
    >
      <template #title>Edit Inventory Location</template>

      <template #description> Update this inventory location.</template>

      <template #content>
        <form
          @submit.prevent="updateInventoryLocation"
          @keydown.enter="updateInventoryLocation"
        >
          <div class="col-span-6 grid gap-4">
            <div class="grid gap-4 sm:grid-cols-2">
              <div class="sm:col-span-2">
                <select-box
                  labelValue="Block Location"
                  :items="blocks"
                  :selectedItem="selectedBlock"
                  v-model="selectedBlock"
                />
                <jet-input-error
                  v-if="!form.block_id"
                  :message="form.errors.block_id"
                  class="mt-2"
                />
              </div>
            </div>
            <div
              v-if="selectedBlock.has_places && !loading"
              class="grid gap-4 sm:grid-cols-2"
            >
              <div class="sm:col-span-1">
                <select-box
                  labelValue="Row Number"
                  :items="rows"
                  :selectedItem="row"
                  v-model="row"
                />
                <jet-input-error
                  v-if="!form.block_id"
                  :message="form.errors.block_id"
                  class="mt-2"
                />
              </div>
              <div class="sm:col-span-1">
                <select-box
                  labelValue="Plant Number"
                  :items="rowPlantNumbers"
                  :selectedItem="place"
                  v-model="place"
                  nameValue="plant_number"
                />
                <jet-input-error
                  v-if="!form.block_id"
                  :message="form.errors.block_id"
                  class="mt-2"
                />
              </div>
            </div>
            <div v-if="loading" class="text-sm">Loading Places...</div>
          </div>
        </form>
      </template>

      <template #footer>
        <div class="flex justify-between items-center w-full">
          <jet-secondary-button
            type="button"
            @click="editingInventoryLocation = false"
            >Cancel</jet-secondary-button
          >
          <div>
            <jet-button
              type="submit"
              @click="updateInventoryLocation"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              >Save Location</jet-button
            >
          </div>
        </div>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import EditIcon from "@heroicons/vue/outline/PencilIcon";
import JetButton from "@/Jetstream/Button.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import SelectBox from "@Components/SelectBox.vue";
import { Inertia } from "@inertiajs/inertia";
export default {
  components: {
    JetDialogModal,
    EditIcon,
    JetInputError,
    JetButton,
    JetSecondaryButton,
    SelectBox,
  },
  props: {
    inventory: Object,
  },
  data() {
    return {
      loading: false,
      editingInventoryLocation: false,
      selectedBlock: this.inventory.block,
      blocks: this.$page.props.blocks,
      row: this.inventory.place
        ? { name: this.inventory.place.row_number }
        : null,
      place: this.inventory.place,
      places: [],
      form: this.$inertia.form(this.inventory),
    };
  },

  watch: {
    selectedBlock(block) {
      if (block) {
        this.form.block_id = block.id;
        this.row = null;
        this.place = null;
        this.getPlaces(block);
      } else {
        this.form.block_id = null;
      }
    },
    row() {
      this.place = null;
    },
    place(place) {
      if (place) {
        this.form.place_id = place.id;
      } else {
        this.form.place_id = null;
      }
    },
  },
  mounted() {
    if (this.selectedBlock?.has_places) {
      this.getPlaces(this.selectedBlock);
    }
  },

  computed: {
    rows() {
      return [...new Set(this.places.map((place) => place.row_number))].map(
        (row) => {
          let obj = {};
          obj.name = row;
          return obj;
        }
      );
    },
    rowPlantNumbers() {
      if (this.places.length && this.row) {
        return this.places.filter((place) => place.row_number == this.row.name);
      }
    },
    nextLocation() {
      if (this.place) {
        return this.places.filter((place) => {
          return (
            place.plant_number === this.place.plant_number + 1 &&
            place.row_number === this.place.row_number
          );
        })[0];
      }
    },
  },

  methods: {
    assignNextPlace() {
      new Promise((resolve, reject) => {
        this.place = this.nextLocation;
        resolve();
      })
        .catch(() => {
          Inertia.reload();
        })
        .then(() => {
          this.updateInventoryLocation();
        });
    },
    updateInventoryLocation() {
      this.form.patch(route("inventory.update", this.inventory), {
        onSuccess: (page) => (this.editingInventoryLocation = false),
      });
    },
    getPlaces(block) {
      this.loading = true;
      axios
        .get(route("api.places.index", block))

        .then((res) => {
          this.places = res.data;
          this.loading = false;
        })

        .catch((error) => {
          console.error(error.message);
        });
    },
  },
};
</script>