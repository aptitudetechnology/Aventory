<template>
  <inertia-link
    :href="href"
    :class="[
      current
        ? 'bg-gray-100 text-gray-900'
        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
      'text-large group flex items-center px-2 py-2 text-base font-medium rounded-md',
    ]"
  >
    <slot></slot>
  </inertia-link>
</template>

<script>
export default {
  props: ["href", "current"],
};
</script>
