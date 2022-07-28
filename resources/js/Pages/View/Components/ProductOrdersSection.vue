<template>
    <details-section class="mb-4">
        <section-title class="mb-0"
            ><template #title
                >Product Orders for size {{ size?.name }}</template
            ></section-title
        >
        <ProductHoldView :product="product" :size="size" />
    </details-section>
</template>
<script>
import DetailsSection from "@/Components/DetailsSection.vue";
import SectionTitle from "@/Jetstream/SectionTitle.vue";
import ProductHoldView from "@/Pages/Orders/Components/ProductHoldView.vue";
export default {
    components: {
        DetailsSection,
        SectionTitle,
        ProductHoldView,
    },
    props: {
        product: {
            type: [Object, Boolean],
            required: false,
        },
        size: {
            type: [Object, Boolean],
            required: false,
        },
    },
};
</script>
