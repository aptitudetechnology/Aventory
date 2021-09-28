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

                    <inventory-size-update
                        :sizes="sizes"
                        :inventory="inventory"
                    />

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
            form: this.$inertia.form(this.inventory),
        };
    },
    mounted() {
        if (localStorage.getItem("locationData")) {
            try {
                const locationData = JSON.parse(
                    localStorage.getItem("locationData")
                );
                if (locationData.autoLocate) {
                    if (
                        locationData.autoLocateToNext &&
                        locationData.nextPlace
                    ) {
                        this.form.block_id = locationData.nextPlace.block_id;
                        this.form.place_id = locationData.nextPlace.id;
                    } else if (locationData.previousPlace) {
                        this.form.block_id =
                            locationData.previousPlace.block_id;
                        this.form.place_id = locationData.previousPlace.id;
                    }
                }
            } catch (e) {
                localStorage.removeItem("locationData");
            }
        }
        // Get local storage for preserving state across pages.
        if (localStorage.getItem("sizeData")) {
            try {
                const sizeData = JSON.parse(localStorage.getItem("sizeData"));
                //update size if autosize is set
                if (sizeData.autosize && sizeData.autosizeSize) {
                    if (
                        localStorage.lastProductId == this.inventory.product_id
                    ) {
                        this.form.size_id = sizeData.autosizeSize.id;
                    }
                }
            } catch (error) {
                localStorage.removeItem("sizeData");
            }
        }
    },
};
</script>
