<template>
  <inertia-link
    :href="href"
    :class="[
      current ? 'border-indigo-500' : 'border-gray-100',
      'p-3 border-b border-gray-100 text-gray-500 hover:text-gray-700 hover:border-gray-300',
    ]"
    ><slot></slot
  ></inertia-link>
</template>
<script>
export default {
  props: { href: String, current: Boolean },
};
</script>
