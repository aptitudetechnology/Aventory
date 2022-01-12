<template>
    <app-layout>
        <main-area :dontShowOnMobile="false">
            <nav v-if="!isIndex" aria-label="Breadcrumb">
                <div class="px-4 md:pb-2">
                    <back-link
                        v-if="route().current('quotes.*')"
                        :href="route('quotes.index')"
                        >Quotes</back-link
                    >
                </div>
            </nav>
            <!-- Main Content -->
            <div class="py-2">
                <slot></slot>
            </div>
        </main-area>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

import BackLink from "@/Components/Links/BackLink";
import MainArea from "@Components/MainArea.vue";

export default {
    components: {
        AppLayout,
        BackLink,
        MainArea,
    },
    computed: {
        isIndex() {
            return route().current("quotes.index");
        },
    },
};
</script>
