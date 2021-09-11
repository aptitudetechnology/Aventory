<template>
  <div>
    <jet-button @click="addingInventory = true"
      >Add Selected to Inventory</jet-button
    >
    <jet-dialog-modal :show="addingInventory" @close="addingInventory = false">
      <template #title>Add these items to inventory.</template>

      <template #description>
        Once you add these items to inventory, you can print their tags. You
        won't be able to make changes to these items once added to inventory
        unless you remove them from inventory.
      </template>

      <template #content>
        <form @submit.prevent="addInventory" @keydown.enter="addInventory">
          <div class="col-span-6 grid gap-4">
            <RadioGroup v-model="selectedType">
              <RadioGroupLabel class="sr-only">
                Type of inventory
              </RadioGroupLabel>
              <JetInputError :message="form.errors.type" />
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
                        ? 'bg-green-50 border-green-200 z-10'
                        : 'border-gray-200',
                      'relative border p-4 flex cursor-pointer focus:outline-none',
                    ]"
                  >
                    <span
                      :class="[
                        checked
                          ? 'bg-green-600 border-transparent'
                          : 'bg-white border-gray-300',
                        active ? 'ring-2 ring-offset-2 ring-green-500' : '',
                        'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center flex-shrink-0',
                      ]"
                      aria-hidden="true"
                    >
                      <span class="rounded-full bg-white w-1.5 h-1.5" />
                    </span>
                    <div class="ml-3 flex flex-col">
                      <RadioGroupLabel
                        as="span"
                        :class="[
                          checked ? 'text-green-900' : 'text-gray-900',
                          'block text-sm font-medium',
                        ]"
                      >
                        {{ type.name }}
                      </RadioGroupLabel>
                      <RadioGroupDescription
                        as="span"
                        :class="[
                          checked ? 'text-green-700' : 'text-gray-500',
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
        </form>
      </template>

      <template #footer>
        <div class="flex justify-between w-full">
          <jet-secondary-button type="button" @click="addingInventory = false"
            >Cancel</jet-secondary-button
          >
          <div>
            <jet-button
              type="submit"
              @click="addInventory"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              >Add items to Inventory</jet-button
            >
          </div>
        </div>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import {
  RadioGroup,
  RadioGroupDescription,
  RadioGroupLabel,
  RadioGroupOption,
} from "@headlessui/vue";

import JetButton from "@/Jetstream/Button";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

const types = [
  {
    name: "Individual",
    value: "individual",
    description:
      "Store these items individually in inventory. Each item will have a unique tag id, and a unique place in the nursery.",
  },
  {
    name: "Group",
    value: "group",
    description:
      "Store items in a group. Items will be sized and given a block location as a whole. Each item will have an matching id tag.",
  },
];

export default {
  components: {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
    JetButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
  },
  props: { selectedItems: Array },

  data() {
    return {
      addingInventory: false,
      types: types,
      selectedType: null,
      form: this.$inertia.form({
        _method: "POST",
        type: null,
        selectedItems: this.selectedItems,
      }),
    };
  },
  watch: {
    selectedType() {
      this.form.type = this.selectedType.value;
    },
  },

  methods: {
    addInventory() {
      this.form.post(route("inventory.store"), {
        preserveScroll: true,
        preserveState: true,
      });
    },
  },
};
</script>
