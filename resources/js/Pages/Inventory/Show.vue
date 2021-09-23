<template>
  <AppLayout>
    <MainArea :dontShowOnMobile="false" class="px-4">
      <SearchInventory />
      <div class="mt-6 grid gap-4 max-w-screen-sm">
        <h1 class="text-lg">{{ inventory.product.name }}</h1>
        <p class="text-md">Plant #: {{ inventory.id }}</p>
        <div v-if="inventory.type == 'group'" class="w-full">
          <JetLabel for="quantity">Quantity</JetLabel>
          <jet-input
            id="quantity"
            type="number"
            v-model="quantity"
            class="block w-full"
          />
        </div>
        <div class="flex items-center space-x-4">
          <select-box
            class="w-full flex items-center space-x-2"
            id="size"
            :items="sizes"
            :selectedItem="selectedSize"
            v-model="selectedSize"
            labelValue="Size"
          />
          <jet-button
            :disabled="!nextSize"
            @click="assignNextSize"
            class="max-w-xs flex-shrink-0"
            >Next Size Up</jet-button
          >
        </div>
        <div class="flex items-center space-x-2">
          <JetButton
            v-for="recent in recentSizes"
            :key="recent.id"
            @click="selectedSize = recent"
            >Change to {{ recent.name }}</JetButton
          >
        </div>

        <div class="flex items-center space-x-2">
          <JetLabel for="autosize">{{ autosizeLabel }}</JetLabel>

          <JetCheckbox :checked="autosize" v-model="autosize" />
        </div>

        <div class="flex items-center space-x-2">
          <JetButton
            v-for="recent in recentSizes"
            :key="recent.id"
            @click="autosizeSize = recent"
            >{{ recent.name }}</JetButton
          >
        </div>
      </div>
    </MainArea>
  </AppLayout>
</template>
<script>
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetInput from "@/Jetstream/Input.vue";
import AppLayout from "@/Layouts/AppLayout";
import MainArea from "@Components/MainArea.vue";
import SelectBox from "@Components/SelectBox.vue";
import SearchInventory from "./SearchInventory.vue";

export default {
  components: {
    JetLabel,
    JetButton,
    JetCheckbox,
    JetInput,
    AppLayout,
    MainArea,
    SelectBox,
    SearchInventory,
  },
  props: {
    inventory: Object,
    sizes: Array,
  },
  data() {
    return {
      quantity: this.inventory.quantity,
      autosize: false,
      autosizeSize: null,
      recentSizes: [],
      selectedSize: this.sizes.find(
        (size) => size.id == this.inventory.size_id
      ),
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
  watch: {
    selectedSize(value) {
      if (!this.recentSizes.includes(value)) {
        if (this.recentSizes.length >= 3) {
          this.recentSizes.shift();
        }
        this.recentSizes.push(value);
      }
    },
  },

  methods: {
    assignNextSize() {
      this.selectedSize = this.nextSize;
    },
  },
};
</script>