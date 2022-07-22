<template>
    <div class="md:grid md:gap-6">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 bg-white sm:p-6 shadow">
                <jet-section-title class="col-span-6">
                    <template #title><slot name="title" /></template>
                    <template #description>
                        <slot name="description" />
                    </template>
                </jet-section-title>
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
import JetSectionTitle from "./SectionTitle";

export default {
    components: {
        JetSectionTitle,
    },
};
</script>
