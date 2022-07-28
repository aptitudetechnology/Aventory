<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
                    <div class="px-4 md:pb-2">
                        <back-link
                            v-if="route().current('blocks.*')"
                            :href="route('blocks.index')"
                            >Blocks</back-link
                        >
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <blocks-aside :blocks="blocks" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackLink from "@/Components/Links/BackLink";
import BlocksAside from "./BlocksAside";
import MainArea from "@/Components/MainArea.vue";

export default {
    components: {
        BlocksAside,
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        blocks() {
            return this.$page.props.blocks;
        },
        isIndex() {
            return route().current("blocks.index");
        },
    },
};
</script>
