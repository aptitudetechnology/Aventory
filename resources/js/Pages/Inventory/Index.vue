<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="false">
        <card class="max-w-screen-sm">
          <search-inventory />
        </card>
      </main-area>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MainArea from "@Components/MainArea.vue";
import Card from "@Components/Card.vue";
import SearchInventory from "./SearchInventory.vue";

export default {
  components: {
    AppLayout,
    MainArea,
    Card,
    SearchInventory,
  },
};
</script>
