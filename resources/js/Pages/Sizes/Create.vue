<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="false">
                <div class="py-2">
                    <div class="sm:pb-4 px-6">
                        <back-link :href="route('sizes.index')"
                            >Sizes</back-link
                        >
                    </div>
                    <create-size-form class="max-w-screen-sm" />
                </div>
            </main-area>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import MainArea from "@/Components/MainArea.vue";
import BackLink from "@/Components/Links/BackLink.vue";

import CreateSizeForm from "./CreateSizeForm.vue";
export default {
    components: {
        AppLayout,
        MainArea,
        CreateSizeForm,
        BackLink,
    },
    computed: {},
};
</script>
