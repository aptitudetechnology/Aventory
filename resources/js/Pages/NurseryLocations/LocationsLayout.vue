<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
                    <div class="px-4 md:pb-2">
                        <back-link
                            v-if="route().current('locations.*')"
                            :href="route('locations.index')"
                            >Locations</back-link
                        >
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <locations-aside :locations="locations" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import BackLink from "@/Components/Links/BackLink.vue";
import LocationsAside from "./LocationsAside.vue";
import MainArea from "@/Components/MainArea.vue";

export default {
    components: {
        LocationsAside,
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        locations() {
            return this.$page.props.locations;
        },
        isIndex() {
            return route().current("locations.index");
        },
    },
};
</script>
