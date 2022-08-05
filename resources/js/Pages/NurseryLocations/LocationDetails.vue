<template>
    <details-section>
        <template #title>{{ location.name }}</template>
        <template #aside
            ><button-link :href="route('locations.edit', location)"
                >Edit Details</button-link
            ></template
        >
        <div class="sm:col-span-1">
            <dt class="text-sm text-gray-500">Address</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ location.address }}</dd>
            <dd class="mt-1 text-sm text-gray-900">
                {{ location.city }} {{ location.state }} {{ location.zip }}
            </dd>
        </div>
    </details-section>
</template>

<script>
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import DetailsSection from "@/Components/DetailsSection.vue";
export default {
    components: {
        ButtonLink,
        DetailsSection,
    },
    props: { location: Object },
};
</script>
