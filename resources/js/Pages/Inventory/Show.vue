<template>
  <AppLayout>
    <MainArea :dontShowOnMobile="false">
      <Card class="max-w-screen-sm">
        <SearchInventory />
        <div class="mt-6 grid divide-y divide-gray-100">
          <div class="py-4">
            <h1 class="text-xl">{{ inventory.product.name }}</h1>
            <p class="text-lg">Plant #: {{ inventory.id }}</p>
          </div>

          <inventory-quantity-update :inventory="inventory" />

          <inventory-size-update :sizes="sizes" :inventory="inventory" />

          <inventory-location-update :inventory="inventory" />
        </div>
      </Card>
    </MainArea>
  </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Card from "@Components/Card.vue";
import MainArea from "@Components/MainArea.vue";
import SearchInventory from "./SearchInventory.vue";
import InventorySizeUpdate from "./Components/InventorySizeUpdate.vue";
import InventoryQuantityUpdate from "./Components/InventoryQuantityUpdate.vue";
import InventoryLocationUpdate from "./Components/InventoryLocationUpdate.vue";
export default {
  components: {
    AppLayout,
    Card,
    MainArea,
    SearchInventory,
    InventorySizeUpdate,
    InventoryQuantityUpdate,
    InventoryLocationUpdate,
  },
  props: {
    inventory: Object,
    sizes: Array,
  },
};
</script>