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
    props: { inventory: Array },

    methods: {
        printTags() {
            window.open(
                route("reprint-tags", {
                    inventory: this.inventory,
                })
            );
            setTimeout(() => {
                Inertia.reload();
            }, 3000);
        },
    },
};
</script>
