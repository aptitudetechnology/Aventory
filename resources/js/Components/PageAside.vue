<template>
  <aside
    :class="[
      showOnMobile ? 'flex flex-col w-full' : 'hidden',
      'xl:order-first xl:flex xl:flex-col flex-shrink-0 lg:w-96 border-r border-gray-200 bg-white',
    ]"
  >
    <div class="p-6 border-b border-gray-100">
      <slot name="header"></slot>
    </div>

    <div class="flex-1 min-h-0 overflow-y-auto">
      <slot></slot>
    </div>
  </aside>
</template>
<script>
export default {
  props: {
    showOnMobile: Boolean,
  },
};
</script>
