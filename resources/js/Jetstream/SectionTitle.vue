<template>
  <div
    class="flex justify-between items-center border-b border-gray-100 pb-4 mb-4"
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
