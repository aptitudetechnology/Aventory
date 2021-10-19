<template>
    <view-layout>
        <details-section>
            <template #title>{{ product.name }}</template>
            <div class="col-span-6 sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Description</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ product.description }}
                </dd>
            </div>
            <div v-if="product.plant" class="col-span-6 sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Size</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    Height: {{ product.plant.height }} Spread:
                    {{ product.plant.spread }}
                </dd>
            </div>
        </details-section>
    </view-layout>
</template>
<script>
import JetButton from "@/Jetstream/Button.vue";
import ViewLayout from "./ViewLayout.vue";
import DetailsSection from "@Components/DetailsSection.vue";
export default {
    components: {
        DetailsSection,
        JetButton,
        ViewLayout,
    },
    props: ["product"],
};
</script>
