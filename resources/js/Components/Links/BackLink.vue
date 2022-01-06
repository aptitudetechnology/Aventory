<template>
  <inertia-link
    :href="href"
    class="
      -ml-1
      inline-flex
      items-center
      space-x-3
      text-sm
      font-medium
      text-blue-gray-900
    "
  >
    <ChevronLeftIcon class="h-5 w-5 text-blue-gray-400" aria-hidden="true" />
    <span><slot></slot></span>
  </inertia-link>
</template>
<script>
import { ChevronLeftIcon } from "@heroicons/vue/solid";
export default {
  components: { ChevronLeftIcon },
  props: { href: String },
};
</script>
