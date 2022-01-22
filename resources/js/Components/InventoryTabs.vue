<template>
    <tab-container class="tabs-boxed px-2">
        <tab-link
            :href="route('inventory.index')"
            :current="route().current('inventory.index')"
            type="pill"
            >Inventory</tab-link
        >
        <tab-link
            :href="route('inventory.clear-locations')"
            :current="route().current('inventory.clear-locations')"
            type="pill"
            >Clear Assigned Locations</tab-link
        >
    </tab-container>
</template>

<script>
import TabContainer from "./TabContainer.vue";
import TabLink from "./Links/TabLink.vue";
export default {
    components: {
        TabContainer,
        TabLink,
    },
};
</script>
