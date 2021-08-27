<template>
  <div>
    <div></div>
    <jet-form-section @submitted="createProduct">
      <template #title>{{ title }}</template>

      <template #description> Create a new product you sell. </template>

      <template #form>
        <div v-if="form.type" class="col-span-6">
          <back-link :href="route('products.create')" class="mb-6"
            >Back to choose product type</back-link
          >
          <div class="grid gap-4" v-if="form.type != 'plant'">
            <div class="col-span-3">
              <jet-label for="name" value="Product Name" />
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autocomplete="off"
              />
              <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-3">
              <category-selector v-model="selectedCategory" />
              <jet-input-error
                :message="form.errors.category_id"
                class="mt-2"
              />
            </div>
            <div class="col-span-3">
              <jet-label for="description" value="Description" />
              <text-area-input
                id="description"
                class="mt-1 block w-full"
                v-model="form.description"
              />
              <jet-input-error
                :message="form.errors.description"
                class="mt-2"
              />
            </div>
          </div>
          <div v-else>
            <div class="grid gap-4">
              <div class="col-span-3">
                <jet-label for="scientific_name" value="Scientific Name" />
                <jet-input
                  id="scientific_name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.scientific_name"
                  required
                  autocomplete="off"
                />
                <jet-input-error
                  :message="form.errors.scientific_name"
                  class="mt-2"
                />
              </div>
              <div class="col-span-3">
                <jet-label for="common_name" value="Common Name" />
                <jet-input
                  id="common_name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.common_name"
                  required
                  autocomplete="off"
                />
                <jet-input-error
                  :message="form.errors.common_name"
                  class="mt-2"
                />
              </div>
              <div class="col-span-3">
                <category-selector v-model="selectedCategory" />
                <jet-input-error
                  :message="form.errors.category_id"
                  class="mt-2"
                />
              </div>
              <div class="col-span-3">
                <jet-label for="description" value="Description" />
                <text-area-input
                  id="description"
                  class="mt-1 block w-full"
                  v-model="form.description"
                />
                <jet-input-error
                  :message="form.errors.description"
                  class="mt-2"
                />
              </div>
            </div>
            <div class="grid gap-4">
              <div class="col-span-3 pt-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Plant details
                </h3>
              </div>

              <div class="grid gap-4 col-span-3 grid-cols-3">
                <div class="col-span-1">
                  <jet-label for="zone">Growing Zone</jet-label>
                  <jet-input
                    id="zone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.zone"
                    autocomplete="off"
                  />
                  <jet-input-error :message="form.errors.zone" class="mt-2" />
                </div>
                <div class="col-span-1">
                  <jet-label for="height">Mature Height</jet-label>
                  <jet-input
                    id="height"
                    type="number"
                    min="0"
                    class="mt-1 block w-full"
                    v-model="form.height"
                    autocomplete="off"
                  />
                  <jet-input-error :message="form.errors.height" class="mt-2" />
                </div>
                <div class="col-span-1">
                  <jet-label for="spread">Mature Spread</jet-label>
                  <jet-input
                    id="spread"
                    type="number"
                    min="0"
                    class="mt-1 block w-full"
                    v-model="form.spread"
                    autocomplete="off"
                  />
                  <jet-input-error :message="form.errors.spread" class="mt-2" />
                </div>
                <div class="col-span-1">
                  <jet-label for="bloom_color">Bloom Color</jet-label>
                  <jet-input
                    id="bloom_color"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.bloom_color"
                    autocomplete="off"
                  />
                  <jet-input-error
                    :message="form.errors.bloom_color"
                    class="mt-2"
                  />
                </div>
                <div class="col-span-1">
                  <jet-label for="fall_color">Fall Color</jet-label>
                  <jet-input
                    id="fall_color"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.fall_color"
                    autocomplete="off"
                  />
                  <jet-input-error
                    :message="form.errors.fall_color"
                    class="mt-2"
                  />
                </div>
                <div class="col-span-1">
                  <jet-label for="growth_rate">Growth Rate</jet-label>
                  <jet-input
                    id="growth_rate"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.growth_rate"
                    autocomplete="off"
                  />
                  <jet-input-error
                    :message="form.errors.growth_rate"
                    class="mt-2"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="col-span-6">
          <RadioGroup v-model="selectedType">
            <RadioGroupLabel class="sr-only">
              Please select the product type.
            </RadioGroupLabel>
            <div class="bg-white rounded-md -space-y-px">
              <RadioGroupOption
                as="template"
                v-for="(type, typeIdx) in types"
                :key="type.name"
                :value="type"
                v-slot="{ checked, active }"
              >
                <div
                  :class="[
                    typeIdx === 0 ? 'rounded-tl-md rounded-tr-md' : '',
                    typeIdx === types.length - 1
                      ? 'rounded-bl-md rounded-br-md'
                      : '',
                    checked
                      ? 'bg-indigo-50 border-indigo-200 z-10'
                      : 'border-gray-200',
                    'relative border p-4 flex cursor-pointer focus:outline-none',
                  ]"
                >
                  <span
                    :class="[
                      checked
                        ? 'bg-indigo-600 border-transparent'
                        : 'bg-white border-gray-300',
                      active ? 'ring-2 ring-offset-2 ring-indigo-500' : '',
                      'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center',
                    ]"
                    aria-hidden="true"
                  >
                    <span class="rounded-full bg-white w-1.5 h-1.5" />
                  </span>
                  <div class="ml-3 flex flex-col">
                    <RadioGroupLabel
                      as="span"
                      :class="[
                        checked ? 'text-indigo-900' : 'text-gray-900',
                        'block text-sm font-medium',
                      ]"
                    >
                      {{ type.name }}
                    </RadioGroupLabel>
                    <RadioGroupDescription
                      as="span"
                      :class="[
                        checked ? 'text-indigo-700' : 'text-gray-500',
                        'block text-sm',
                      ]"
                    >
                      {{ type.description }}
                    </RadioGroupDescription>
                  </div>
                </div>
              </RadioGroupOption>
            </div>
          </RadioGroup>
        </div>
      </template>

      <template #actions>
        <jet-button
          v-show="form.type"
          type="submit"
          :class="{ 'opacity-25': form.processing || !form.name }"
          :disabled="form.processing || !form.name"
          >Save Product</jet-button
        >
      </template>
    </jet-form-section>
  </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

import TextAreaInput from "../../Components/TextAreaInput.vue";
import SelectBox from "../../Components/SelectBox.vue";
import BackLink from "../../Components/BackLink";
import {
  RadioGroup,
  RadioGroupDescription,
  RadioGroupLabel,
  RadioGroupOption,
} from "@headlessui/vue";
import CategorySelector from "./CategorySelector.vue";
const types = [
  {
    name: "Plant",
    value: "plant",
    description:
      "This type of product is a plant, and will have extra details added to display.",
  },
  {
    name: "Inventory",
    value: "inventory",
    description:
      "Inventory products are products that you track inventory of, but are not plants.",
  },
  {
    name: "Non-Inventory",
    value: "non-inventory",
    description:
      "Non Inventory products are products that you sell but do not track inventory of.",
  },
  {
    name: "Service",
    value: "service",
    description:
      "Services are not tangible items that are sold, but services to a customer. Ex: planting",
  },
];
export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    TextAreaInput,
    BackLink,
    SelectBox,
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
    CategorySelector,
  },

  data() {
    return {
      selectedCategory: null,
      selectedType: null,
      types: types,
      form: this.$inertia.form({
        _method: "POST",
        name: "",
        scientific_name: "",
        common_name: "",
        description: "",
        category_id: null,
        type: null,
        zone: null,
        height: null,
        spread: null,
        bloom_color: null,
        fall_color: null,
        growth_rate: null,
      }),
    };
  },
  watch: {
    name() {
      this.form.name = this.name;
    },
    selectedType() {
      this.form.type = this.selectedType.value;
    },
    selectedCategory() {
      this.form.category_id = this.selectedCategory.id;
    },
  },
  computed: {
    name() {
      if (this.form.type == "plant" && this.form.scientific_name) {
        return this.form.scientific_name + " / " + this.form.common_name;
      } else {
        return this.form.name;
      }
    },
    title() {
      if (this.selectedType) {
        if (
          this.selectedType.name != "Service" &&
          this.selectedType.name != "Plant"
        ) {
          return "Create an " + this.selectedType.name + " Product";
        } else {
          return "Create a " + this.selectedType.name;
        }
      } else {
        return "Select the Type of Product to Create";
      }
    },
  },

  methods: {
    createProduct() {
      this.form.post(route("products.store"), {
        errorBag: "createProduct",
        preserveScroll: true,
      });
    },
  },
};
</script>
