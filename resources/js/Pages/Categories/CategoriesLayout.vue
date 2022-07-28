<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
                    <div class="px-4 md:pb-2">
                        <back-link :href="route('categories.index')"
                            >Categories</back-link
                        >
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <categories-aside :categories="categories" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import BackLink from "@/Components/Links/BackLink.vue";
import CategoriesAside from "./CategoriesAside.vue";
import MainArea from "@/Components/MainArea.vue";

export default {
    components: {
        CategoriesAside,
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        categories() {
            return this.$page.props.categories;
        },
        isIndex() {
            return route().current("categories.index");
        },
    },
};
</script>
