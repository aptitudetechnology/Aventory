<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
                    <div class="px-4 md:pb-2">
                        <back-link :href="route('customer-price-levels.index')"
                            >Price Levels</back-link
                        >
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <price-levels-aside :priceLevels="priceLevels" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackLink from "@/Components/Links/BackLink";
import PriceLevelsAside from "./PriceLevelsAside.vue";
import MainArea from "@/Components/MainArea.vue";

export default {
    components: {
        PriceLevelsAside,
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        priceLevels() {
            return this.$page.props.priceLevels;
        },
        isIndex() {
            return route().current("price-levels.index");
        },
    },
};
</script>
