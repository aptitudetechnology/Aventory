<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
                    <div class="px-4 md:pb-2">
                        <back-link
                            v-if="route().current('purchases.*')"
                            :href="route('purchases.index')"
                            >Purchases</back-link
                        >
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <purchases-aside :purchases="purchases" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

import BackLink from "@/Components/Links/BackLink";
import MainArea from "@Components/MainArea.vue";

import PurchasesAside from "./Components/PurchasesAside";

export default {
    components: {
        PurchasesAside,
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        purchases() {
            return this.$page.props.purchases;
        },
        isIndex() {
            return (
                route().current("purchases.index") ||
                route().current("archived-purchases.index")
            );
        },
    },
};
</script>
