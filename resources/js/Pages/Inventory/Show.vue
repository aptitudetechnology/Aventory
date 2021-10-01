<template>
  <AppLayout>
    <MainArea :dontShowOnMobile="false">
      <Card class="max-w-screen-sm">
        <SearchInventory />
        <div class="mt-6 grid divide-y divide-gray-100">
          <div class="py-4">
            <h1 class="text-xl">{{ inventory.product.name }}</h1>
            <p class="text-lg">
              {{ inventory.type == "group" ? "Group " : "Plant " }}#:
              <span class="text-green-600">{{ inventory.id }}</span>
            </p>
            <p
              v-if="autoLocateNotice.message"
              :class="[
                autoLocateNotice.wasAutoLocated
                  ? 'text-green-600'
                  : 'text-red-500',
                'mt-2',
              ]"
            >
              {{ autoLocateNotice.message }}
            </p>
          </div>

          <inventory-quantity-update :inventory="inventory" />

          <inventory-size-update :sizes="sizes" :inventory="inventory" />

          <inventory-location-update
            :inventory="inventory"
            @autolocated="updateLocatedNotice"
          />

          <p class="pt-4">
            Last Inventoried: {{ inventory.last_inventory_date }}
          </p>
        </div>
      </Card>
    </MainArea>
  </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Card from "@Components/Card.vue";
import MainArea from "@Components/MainArea.vue";
import SearchInventory from "./Components/SearchInventory.vue";
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
  data() {
    return {
      autoLocateNotice: {
        wasAutoLocated: false,
        message: null,
      },
    };
  },
  unmounted() {
    localStorage.lastInventoryId = this.inventory.id;
  },
  methods: {
    updateLocatedNotice(event) {
      this.autoLocateNotice = event;
    },
  },
};
</script>
