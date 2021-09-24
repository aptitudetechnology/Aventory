<template>
  <div class="mt-6 flex space-x-4">
    <div class="flex-1 min-w-0">
      <label for="search" class="sr-only">Search</label>
      <div class="relative rounded-md shadow-sm">
        <div
          class="
            absolute
            inset-y-0
            left-0
            pl-3
            flex
            items-center
            pointer-events-none
          "
        >
          <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </div>
        <jet-input
          :value="modelValue"
          @input="$emit('update:modelValue', $event.target.value)"
          ref="input"
          :type="type"
          name="search"
          id="search"
          :autocomplete="autocomplete"
          :autofocus="autofocus"
          class="
            focus:ring-green-500
            focus:border-green-500
            block
            w-full
            pl-10
            sm:text-sm
            border-gray-300
            rounded-md
          "
          :placeholder="placeholder"
        />
      </div>
    </div>
  </div>
</template>

<script>
import JetInput from "@/Jetstream/Input.vue";
import SearchIcon from "@heroicons/vue/solid/SearchIcon";

export default {
  components: {
    JetInput,
    SearchIcon,
  },
  props: {
    modelValue: String,
    placeholder: { type: String, default: "Search" },
    autofocus: { type: Boolean, default: false },
    autocomplete: { type: String, default: "off" },
    type: { type: String, default: "search" },
  },

  emits: ["update:modelValue"],
  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
};
</script>
