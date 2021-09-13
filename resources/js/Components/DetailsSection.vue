<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex items-center space-x-2 justify-between">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        <slot name="header" />
      </h3>

      <slot name="aside" />
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
      <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <slot></slot>
      </dl>
    </div>
  </div>
</template>
