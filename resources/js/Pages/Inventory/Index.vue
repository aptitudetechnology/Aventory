<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="false">
                <InventoryTabs />
                <card class="max-w-screen-sm">
                    <search-inventory />
                </card>
                <InventoryList
                    class="mt-6"
                    :inventory="inventory"
                    :filters="filters"
                />
            </main-area>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MainArea from "@Components/MainArea.vue";
import Card from "@Components/Card.vue";
import InventoryTabs from "@Components/InventoryTabs.vue";
import SearchInventory from "./Components/SearchInventory.vue";
import InventoryList from "./Components/InventoryList.vue";

export default {
    components: {
        AppLayout,
        MainArea,
        Card,
        InventoryTabs,
        SearchInventory,
        InventoryList,
    },
    props: {
        inventory: {
            type: Object,
            required: true,
        },
        filters: {
            type: Object,
        },
    },
};
</script>
