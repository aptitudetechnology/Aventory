<template>
  <div class="py-4 grid gap-4">
    <h2 class="text-xl">Plant Size</h2>
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
        v-for="recent in recentSizes"
        :key="recent.id"
        :disabled="this.selectedSize.id == recent.id"
        @click="selectedSize = recent"
        >{{ recent.name }}</JetButton
      >
    </div>

    <div class="flex items-center space-x-2">
      <JetLabel for="autosize" class="text-lg">{{ autosizeLabel }}</JetLabel>

      <JetCheckbox :checked="autosize" v-model="autosize" />
    </div>
    <div class="flex items-center space-x-2">
      <JetButton
        v-for="recent in recentSizes"
        :key="recent.id + 'recent'"
        @click="autosizeSize = recent"
        :disabled="this.autosizeSize.id == recent.id"
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
      autosize: false,
      autosizeSize: null,
      recentSizes: [],
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
      if (this.autosizeSize) {
        return "Autosize to " + this.autosizeSize.name;
      } else {
        return "Autosize";
      }
    },
  },
  mounted() {
    // Get local storage for preserving state across pages.
    if (localStorage.getItem("autosizeSize")) {
      try {
        this.autosizeSize = JSON.parse(localStorage.getItem("autosizeSize"));
      } catch (error) {
        localStorage.removeItem("autosizeSize");
      }
    }

    if (localStorage.getItem("recentSizes")) {
      try {
        this.recentSizes = JSON.parse(localStorage.getItem("recentSizes"));
      } catch (error) {
        localStorage.removeItem("recentSizes");
      }
    }

    if (localStorage.autosize) {
      localStorage.autosize == "true"
        ? (this.autosize = true)
        : (this.autosize = false);
    }
  },
  watch: {
    //Set local storage state.
    autosizeSize(size) {
      localStorage.setItem("autosizeSize", JSON.stringify(size));
    },
    autosize(bool) {
      localStorage.autosize = bool;
    },
    recentSizes: {
      handler(sizes) {
        localStorage.setItem("recentSizes", JSON.stringify(sizes));
      },
      deep: true,
    },

    selectedSize(value) {
      if (!this.recentSizes.map((item) => item.id).includes(value.id)) {
        if (this.recentSizes.length >= 3) {
          this.recentSizes.shift();
        }
        this.recentSizes.push(value);
      }
      if (value) {
        this.form.size_id = value.id;
        this.updateSize();
      }
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