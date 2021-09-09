<template>
  <input
    type="checkbox"
    :value="value"
    :disabled="disabled"
    v-model="proxyChecked"
    :class="[
      'focus:ring-' + color + '-200',
      'text-' + color + '-600',
      'rounded border-gray-300 shadow-sm focus:border-none focus:ring   focus:ring-opacity-50 ',
    ]"
  />
</template>

<script>
export default {
  emits: ["update:checked"],

  props: {
    color: {
      default: "green",
      type: String,
    },
    checked: {
      type: [Array, Boolean],
      default: false,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    value: {
      default: null,
    },
  },

  computed: {
    proxyChecked: {
      get() {
        return this.checked;
      },

      set(val) {
        this.$emit("update:checked", val);
      },
    },
  },
};
</script>
