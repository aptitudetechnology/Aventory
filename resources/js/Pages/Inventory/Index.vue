<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="false">
                <InventoryTabs />
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
import InventoryTabs from "@Components/InventoryTabs.vue";
import SearchInventory from "./Components/SearchInventory.vue";

export default {
    components: {
        AppLayout,
        MainArea,
        Card,
        InventoryTabs,
        SearchInventory,
    },
};
</script>
