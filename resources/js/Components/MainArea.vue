<template>
  <main
    :class="[
      dontShowOnMobile ? 'hidden lg:block' : '',
      'flex-1 relative z-0 overflow-y-auto focus:outline-none md:order-last',
    ]"
  >
    <div class="py-6 sm:px-6">
      <slot></slot>
    </div>
  </main>
</template>

<script>
export default {
  props: { dontShowOnMobile: Boolean },
};
</script>
