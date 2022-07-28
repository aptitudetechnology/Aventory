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
                            v-if="route().current('products.*')"
                            :href="route('products.index')"
                            >Products</back-link
                        >
                        <back-link
                            v-else
                            :href="route('archived-products.index')"
                            >Archived Products</back-link
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
            <products-aside />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackLink from "@/Components/Links/BackLink";
import ProductsAside from "@/Pages/Products/ProductsAside";
import MainArea from "@/Components/MainArea.vue";

export default {
    components: {
        ProductsAside,
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        isIndex() {
            return (
                route().current("products.index") ||
                route().current("archived-products.index")
            );
        },
    },
};
</script>
