<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
                    <div class="px-4 md:pb-2">
                        <back-link
                            v-if="route().current('customers.*')"
                            :href="route('customers.index')"
                            >Customers</back-link
                        >
                        <back-link
                            v-else
                            :href="route('archived-customers.index')"
                            >Archived Customers</back-link
                        >
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <customers-aside />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import BackLink from "@/Components/Links/BackLink.vue";
import CustomersAside from "@/Pages/Customers/CustomersAside.vue";
import MainArea from "@/Components/MainArea.vue";

export default {
    components: {
        CustomersAside,
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        isIndex() {
            return (
                route().current("customers.index") ||
                route().current("archived-customers.index")
            );
        },
    },
};
</script>
