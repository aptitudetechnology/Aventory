<template>
  <div class="py-4 grid gap-3">
    <h2 class="text-xl">Plant Size</h2>
    <p
      v-if="autosizedNotice.message"
      :class="[
        autosizedNotice.wasAutosized ? 'text-green-600' : 'text-red-500',
      ]"
    >
      {{ autosizedNotice.message }}
    </p>
    <div class="flex items-center space-x-4">
      <select-box
        class="w-full flex items-center space-x-2"
        id="size"
        :items="sizes"
        :selectedItem="selectedSize"
        v-model="selectedSize"
        :showLabel="false"
      />
      <jet-button
        :disabled="!nextSize"
        @click="assignNextSize"
        class="max-w-xs flex-shrink-0"
        >Next Size Up</jet-button
      >
    </div>
    <div class="flex items-center space-x-2">
      <jet-label class="text-lg">Change to: </jet-label>
      <JetButton
        v-for="recent in sizeData.recentSizes"
        :key="recent.id"
        :disabled="this.selectedSize.id == recent.id"
        @click="selectedSize = recent"
        >{{ recent.name }}</JetButton
      >
    </div>

    <div class="flex items-center space-x-2">
      <JetLabel for="autosize" class="text-lg">{{ autosizeLabel }}</JetLabel>

      <JetCheckbox :checked="sizeData.autosize" v-model="sizeData.autosize" />
    </div>
    <div class="flex items-center space-x-2">
      <JetButton
        v-for="recent in sizeData.recentSizes"
        :key="recent.id + 'recent'"
        @click="sizeData.autosizeSize = recent"
        :disabled="sizeData.autosizeSize?.id == recent.id"
        >{{ recent.name }}</JetButton
      >
    </div>
  </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetInput from "@/Jetstream/Input.vue";
import SelectBox from "@Components/SelectBox.vue";

export default {
  components: {
    JetLabel,
    JetButton,
    JetCheckbox,
    JetInput,
    SelectBox,
  },
  props: {
    inventory: Object,
    sizes: Array,
  },
  data() {
    return {
      sizeData: {
        autosize: false,
        autosizeSize: null,
        recentSizes: [],
      },
      autosizedNotice: {
        wasAutosized: true,
        message: null,
      },
      selectedSize: this.sizes.find(
        (size) => size.id == this.inventory.size_id
      ),
      form: this.$inertia.form(this.inventory),
    };
  },
  computed: {
    nextSize() {
      if (this.selectedSize.next_size_id) {
        return this.sizes.find(
          (size) => size.id == this.selectedSize.next_size_id
        );
      }
    },
    autosizeLabel() {
      if (this.sizeData.autosizeSize) {
        return "Autosize to " + this.sizeData.autosizeSize.name;
      } else {
        return "Autosize";
      }
    },
  },
  mounted() {
    // Get local storage for preserving state across pages.
    if (localStorage.getItem("sizeData")) {
      try {
        this.sizeData = JSON.parse(localStorage.getItem("sizeData"));
      } catch (error) {
        localStorage.removeItem("sizeData");
      }

      //update size if autosize is set and last inventory item is not the same as current (if a user refreshes page ect).
      if (
        this.sizeData.autosize &&
        this.sizeData.autosizeSize &&
        this.inventory.id != localStorage.lastInventoryId
      ) {
        if (localStorage.lastProductId == this.inventory.product_id) {
          new Promise((resolve, reject) => {
            this.selectedSize = this.sizeData.autosizeSize;
            resolve();
          }).then(() => {
            this.autosizedNotice = {
              wasAutosized: true,
              message: "Autosized to " + this.selectedSize.name,
            };
          });
        } else {
          this.sizeData.autosize = false;
          this.autosizedNotice = {
            wasAutosized: false,
            message: "New Product. Size was not autosized",
          };
        }
      }
    }
  },
  beforeUnmount() {
    localStorage.lastProductId = this.inventory.product_id;
  },
  watch: {
    //Set local storage state.
    sizeData: {
      handler(data) {
        localStorage.setItem("sizeData", JSON.stringify(data));
      },
      deep: true,
    },

    selectedSize(value) {
      if (
        !this.sizeData.recentSizes.map((item) => item.id).includes(value.id)
      ) {
        if (this.sizeData.recentSizes.length >= 3) {
          this.sizeData.recentSizes.shift();
        }
        this.sizeData.recentSizes.push(value);
      }
      if (value) {
        this.form.size_id = value.id;
        this.updateSize();
      }
      this.autosizedNotice.message = null;
    },
  },

  methods: {
    assignNextSize() {
      this.selectedSize = this.nextSize;
    },
    currentSize(size) {
      return this.selectedSize.id == size.id;
    },
    updateSize() {
      this.form.patch(route("inventory.update", this.inventory));
    },
  },
};
</script>