<template>
  <div class="py-4 grid gap-4">
    <div class="flex flex-wrap items-center justify-between">
      <h2 class="text-xl">Inventory Location</h2>
      <jet-button @click="editingInventoryLocation = true" class="ml-auto pl-2"
        ><EditIcon class="w-4 h-4 mr-2"></EditIcon> Edit</jet-button
      >
    </div>
    <p
      v-if="autoLocateNotice.message"
      :class="[
        autoLocateNotice.wasAutoLocated ? 'text-green-600' : 'text-red-500',
      ]"
    >
      {{ autoLocateNotice.message }}
    </p>

    <p v-if="inventory.block">Block: {{ inventory.block.name }}</p>
    <p v-else class="text-red-500">Location Unasigned!</p>
    <div v-if="inventory.block && inventory.place" class="grid gap-4">
      <p>
        Place: Row number: {{ inventory.place.row_number }} Plant Number:
        {{ inventory.place.plant_number }}
      </p>
      <jet-label class="text-lg">
        Autolocate?
        <jet-checkbox
          :checked="locationData.autoLocate"
          v-model="locationData.autoLocate"
          class="ml-2"
        />
      </jet-label>
      <div
        v-if="locationData.autoLocate"
        class="flex space-between-4 items-center"
      >
        <jet-label
          >Autolocate to previous
          <input
            type="radio"
            v-bind:value="false"
            v-model="locationData.autoLocateToNext"
            class="
              ml-2
              border-gray-300
              shadow-sm
              focus:border-none
              focus:ring-1 focus:ring-current focus:ring-opacity-50
              cursor-pointer
              text-green-600
            "
          />
        </jet-label>
        <jet-label
          >Autolocate to next
          <input
            type="radio"
            v-bind:value="true"
            v-model="locationData.autoLocateToNext"
            class="
              ml-2
              border-gray-300
              shadow-sm
              focus:border-none
              focus:ring-1 focus:ring-current focus:ring-opacity-50
              cursor-pointer
              text-green-600
            "
          />
        </jet-label>
      </div>
    </div>
    <div
      v-if="inventory.block && inventory.place"
      class="flex items-center justify-between space-x-2 w-full"
    >
      <jet-button
        :disabled="!locationData.previousPlace"
        @click="assignNextPlace(locationData.previousPlace)"
        class="flex-shrink-0 pl-2"
        ><ChevronLeftIcon class="w-4 h-4 mr-2" /> Previous</jet-button
      >
      <jet-button
        :disabled="!locationData.nextPlace"
        @click="assignNextPlace(locationData.nextPlace)"
        class="flex-shrink-0 pr-2"
        >Next<ChevronRightIcon class="w-4 h-4 ml-2"
      /></jet-button>
    </div>

    <p
      v-else-if="inventory.block && inventory.block.has_places"
      class="text-red-500"
    >
      Place Unasigned!
    </p>

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
              v-if="selectedBlock?.has_places && !loading"
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
import ChevronLeftIcon from "@heroicons/vue/outline/ChevronLeftIcon";
import ChevronRightIcon from "@heroicons/vue/outline/ChevronRightIcon";
import JetButton from "@/Jetstream/Button.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import SelectBox from "@Components/SelectBox.vue";
export default {
  components: {
    ChevronLeftIcon,
    ChevronRightIcon,
    JetDialogModal,
    EditIcon,
    JetInputError,
    JetLabel,
    JetCheckbox,
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
      locationData: {
        nextPlace: null,
        previousPlace: null,
        autoLocate: true,
        autoLocateToNext: true,
      },
      autoLocateNotice: {
        wasAutoLocated: true,
        message: null,
      },
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
    locationData: {
      handler(value) {
        localStorage.setItem("locationData", JSON.stringify(value));
      },
      deep: true,
    },
    selectedBlock(block) {
      if (block) {
        this.form.block_id = block.id;
        this.row = null;
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
        this.updateNextandPrevious();
      } else {
        this.form.place_id = null;
      }
    },
  },
  mounted() {
    if (this.selectedBlock?.has_places) {
      this.getPlaces(this.selectedBlock);
    }

    if (localStorage.getItem("locationData")) {
      try {
        this.locationData = JSON.parse(localStorage.getItem("locationData"));
        if (
          this.locationData.autoLocate &&
          this.inventory.id != localStorage.lastInventoryId
        ) {
          if (this.locationData.autoLocateToNext) {
            if (this.locationData.nextPlace) {
              new Promise((resolve, reject) => {
                this.selectedBlock = this.blocks.find(
                  (block) => (block.id = this.locationData.nextPlace.block_id)
                );
                resolve();
              }).then(() => {
                this.assignNextPlace(this.locationData.nextPlace);
                this.autoLocateNotice = {
                  wasAutoLocated: true,
                  message: `Autolocated to next place: row# ${this.place.row_number}, plant# ${this.place.plant_number}`,
                };
              });
            } else {
              this.autoLocateNotice = {
                wasAutoLocated: false,
                message: "Was not autolocated. No more places in current row.",
              };
            }
          } else if (this.locationData.previousPlace) {
            new Promise((resolve, reject) => {
              this.selectedBlock = this.blocks.find(
                (block) => (block.id = this.locationData.previousPlace.block_id)
              );
              resolve();
            }).then(() => {
              this.assignNextPlace(this.locationData.previousPlace);
              this.autoLocateNotice = {
                wasAutoLocated: true,
                message: `Autolocated to previous place: row# ${this.place.row_number}, plant# ${this.place.plant_number}`,
              };
            });
          } else {
            this.autoLocateNotice = {
              wasAutoLocated: false,
              message:
                "Was not autolocated. Reached first place in current row.",
            };
          }
        }
      } catch (e) {
        localStorage.removeItem("locationData");
      }
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
  },

  methods: {
    updateNextandPrevious() {
      if (this.place) {
        this.locationData.previousPlace = this.places.filter((place) => {
          return (
            place.plant_number === this.place.plant_number - 1 &&
            place.row_number === this.place.row_number
          );
        })[0];

        this.locationData.nextPlace = this.places.filter((place) => {
          return (
            place.plant_number === this.place.plant_number + 1 &&
            place.row_number === this.place.row_number
          );
        })[0];
      }
    },
    assignNextPlace(location) {
      new Promise((resolve, reject) => {
        if (location) {
          this.place = location;
          resolve();
        } else {
          reject("There are no more places in this row.");
        }
      })
        .catch((error) => {
          console.error(error);
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
          this.updateNextandPrevious();
        })

        .catch((error) => {
          console.error(error.message);
        });
    },
  },
};
</script>
