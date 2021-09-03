<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="false">
        <div class="py-2">
          <div class="pb-4 px-6">
            <button-link :href="route('sizes.create')">New Size</button-link>
          </div>

          <size-list />
        </div>
      </main-area>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MainArea from "@Components/MainArea.vue";
import SizeList from "./SizeList.vue";
import ButtonLink from "@Components/ButtonLink";
export default {
  components: {
    AppLayout,
    MainArea,
    SizeList,
    ButtonLink,
  },
  computed: {},
};
</script>
