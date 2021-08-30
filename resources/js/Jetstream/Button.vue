<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-4
      py-2
      border border-transparent
      shadow-sm
      text-sm
      font-medium
      rounded-md
      text-white
      bg-green-600
      hover:bg-green-700
      focus:outline-none
      focus:ring-2 focus:ring-offset-2 focus:ring-green-500
      disabled:opacity-25
      transition
    "
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: "submit",
    },
  },
};
</script>
