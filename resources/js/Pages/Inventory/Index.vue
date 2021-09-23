<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="false">
        <div class="py-2">
          <search-inventory />
        </div>
      </main-area>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MainArea from "@Components/MainArea.vue";
import SearchInventory from "./SearchInventory.vue";
export default {
  components: {
    AppLayout,
    MainArea,
    SearchInventory,
  },
};
</script>
