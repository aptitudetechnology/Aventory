<template>
  <div
    :class="[
      showBorder ? 'border-b border-gray-100 mb-4' : '',
      'flex justify-between items-center space-x-4  pb-2',
    ]"
  >
    <div>
      <h3 class="text-xl font-medium text-gray-900">
        <slot name="title"></slot>
      </h3>

      <p class="mt-1 text-sm text-gray-600">
        <slot name="description"></slot>
      </p>
    </div>

    <div>
      <slot name="aside"></slot>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    showBorder: {
      type: Boolean,
      default: true,
    },
  },
};
</script>
