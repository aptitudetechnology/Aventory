<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav
                    v-if="!isIndex"
                    aria-label="Breadcrumb"
                    class="px-4 md:pb-2 flex items-center justify-between"
                >
                    <div class="xl:hidden">
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
            <view-aside />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackLink from "@/Components/Links/BackLink";
import ViewAside from "@/Pages/View/ViewAside";
import MainArea from "@Components/MainArea.vue";

export default {
    components: {
        ViewAside,
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
