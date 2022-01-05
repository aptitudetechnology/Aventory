<template>
    <details-section>
        <div class="flex items-center">
            <PrintButton @click="printOrder" class="mr-2"
                >Print Order</PrintButton
            >
        </div>
    </details-section>
</template>

<script>
import DetailsSection from "@Components/DetailsSection.vue";
import PrintButton from "@Components/Buttons/PrintButton.vue";

export default {
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    components: {
        DetailsSection,
        PrintButton,
    },
    methods: {
        printOrder() {
            this.showPopup(route("orders.print", this.order.id), "PrintOrder");
        },
    },
};
</script>
