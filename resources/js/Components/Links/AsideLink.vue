<template>
  <inertia-link
    :href="href"
    :class="[
      current ? 'bg-gray-50' : '',
      'relative px-6 py-5 flex items-center space-x-3 hover:bg-gray-50',
    ]"
  >
    <slot></slot>
  </inertia-link>
</template>
<script>
export default {
  props: { href: String, current: Boolean },
};
</script>
