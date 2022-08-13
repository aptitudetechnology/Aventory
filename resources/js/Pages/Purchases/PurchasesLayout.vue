<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area>
                <nav v-if="!isIndex" aria-label="Breadcrumb">
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
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

import BackLink from "@/Components/Links/BackLink.vue";
import MainArea from "@/Components/MainArea.vue";

export default {
    components: {
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        isIndex() {
            return (
                route().current("purchases.index") ||
                route().current("archived-purchases.index")
            );
        },
    },
};
</script>
