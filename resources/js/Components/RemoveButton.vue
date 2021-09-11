<template>
  <button class="hover:opacity-50 transition p-2">
    <RemoveIcon :class="('stroke-current', ['w-' + size, 'h-' + size])" />
  </button>
</template>

<script>
import RemoveIcon from "@heroicons/vue/outline/DocumentRemoveIcon";
export default {
  props: { size: { default: 4 } },
  components: {
    RemoveIcon,
  },
};
</script>
