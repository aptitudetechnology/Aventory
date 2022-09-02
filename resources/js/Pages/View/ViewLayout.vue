<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area>
                <nav
                    v-if="!isIndex"
                    aria-label="Breadcrumb"
                    class="px-4 md:pb-2 flex items-center justify-between"
                >
                    <div>
                        <back-link
                            v-if="route().current('view.*')"
                            :href="route('view.index')"
                            >Products</back-link
                        >
                    </div>
                    <slot name="nav"></slot>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <slot name="asside"></slot>
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
            return route().current("view.index");
        },
    },
};
</script>
