<template>
    <print-button @click="printTags">Print Tags</print-button>
</template>

<script>
import PrintButton from "@/Components/Buttons/PrintButton.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        PrintButton,
    },
    props: { purchase_items: Array },

    methods: {
        printTags() {
            window.open(
                route("print-items-tags", {
                    purchase_items: this.purchase_items,
                })
            );
            setTimeout(() => {
                Inertia.reload();
            }, 3000);
        },
    },
};
</script>
