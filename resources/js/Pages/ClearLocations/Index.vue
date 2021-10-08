<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="false">
        <tab-container>
          <tab-link
            :href="route('inventory.index')"
            :current="route().current('inventory.index')"
            >Inventory</tab-link
          >
          <tab-link
            :href="route('inventory.clear-locations')"
            :current="route().current('inventory.clear-locations')"
            >Clear Assigned Locations</tab-link
          >
        </tab-container>
        <div class="flex items-center justify-center py-20">
          <Card class="w-full max-w-screen-md">
            <h2>Please select a block</h2>
          </Card>
        </div>
      </main-area>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MainArea from "@Components/MainArea.vue";
import TabContainer from "@Components/TabContainer.vue";
import TabLink from "@Components/TabLink.vue";
import Card from "@Components/Card.vue";

export default {
  components: {
    AppLayout,
    MainArea,
    TabContainer,
    TabLink,
    Card,
  },
};
</script>
