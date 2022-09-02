<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import BackLink from "@/Components/Links/BackLink.vue";
import MainArea from "@/Components/MainArea.vue";

function isIndex() {
    return route().current("reports.index");
}
</script>

<template>
    <app-layout>
        <main-area :dontShowOnMobile="false">
            <nav v-if="!isIndex" aria-label="Breadcrumb">
                <div class="px-4 md:pb-2">
                    <back-link :href="route('reports.index')"
                        >Back to all reports</back-link
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
