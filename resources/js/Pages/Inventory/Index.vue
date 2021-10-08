<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="false">
        <tab-container>
          <tab-link :href="route('inventory.index')" :current="route().current('inventory.index')">Inventory</tab-link>
          <tab-link :href="route('inventory.clear-locations')" :current="route().current('inventory.clear-locations')">Clear Assigned Locations</tab-link>
        </tab-container>
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
import TabContainer from "@Components/TabContainer.vue";
import TabLink from "@Components/TabLink.vue"
import SearchInventory from "./Components/SearchInventory.vue";

export default {
  components: {
    AppLayout,
    MainArea,
    Card,
    TabContainer,
    TabLink,
    SearchInventory,
  },
};
</script>
