
<template>
  <Listbox as="div" v-model="selected">
    <ListboxLabel
      v-if="showLabel"
      class="block text-sm font-medium text-gray-700"
    >
      {{ labelValue }}
    </ListboxLabel>
    <div class="mt-1 relative">
      <ListboxButton
        class="
          bg-white
          relative
          w-full
          border border-gray-300
          rounded-md
          shadow-sm
          pl-3
          pr-10
          py-2
          text-left
          cursor-default
          focus:outline-none
          focus:ring-1 focus:ring-green-500
          focus:border-green-500
        "
      >
        <span v-if="selected" class="block truncate text-gray-900">{{
          selected.name
        }}</span>
        <span v-else class="block truncate">Select</span>
        <span
          class="
            absolute
            inset-y-0
            right-0
            flex
            items-center
            pr-2
            pointer-events-none
          "
        >
          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </span>
      </ListboxButton>

      <transition
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <ListboxOptions
          class="
            absolute
            z-10
            mt-1
            w-full
            bg-white
            shadow-lg
            max-h-60
            rounded-md
            py-1
            text-base
            ring-1 ring-black ring-opacity-5
            overflow-auto
            focus:outline-none
            sm:text-sm
          "
        >
          <ListboxOption as="template">
            <li
              class="
                text-gray-900
                cursor-default
                select-none
                relative
                py-2
                pl-3
                pr-9
              "
            >
              <span class="font-normal block truncate"> Clear selected </span>
            </li>
          </ListboxOption>
          <ListboxOption
            as="template"
            v-for="item in items"
            :key="item.id"
            :value="item"
            v-slot="{ active, selected }"
          >
            <li
              :class="[
                active ? 'text-white bg-green-600' : 'text-gray-900',
                'cursor-default select-none relative py-2 pl-3 pr-9',
              ]"
            >
              <span
                :class="[
                  selected ? 'font-semibold' : 'font-normal',
                  'block truncate',
                ]"
              >
                {{ item.name }}
              </span>

              <span
                v-if="selected"
                :class="[
                  active ? 'text-white' : 'text-green-600',
                  'absolute inset-y-0 right-0 flex items-center pr-4',
                ]"
              >
                <CheckIcon class="h-5 w-5" aria-hidden="true" />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>

<script>
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";

export default {
  components: {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  props: {
    items: Array,
    selectedItem: Object | Boolean,
    labelValue: { type: String, default: "Select Option" },
    showLabel: { type: Boolean, default: true },
  },
  data: function () {
    return {
      selected: this.selectedItem,
    };
  },
  watch: {
    selectedItem() {
      this.selected = this.selectedItem;
    },
  },
};
</script>
