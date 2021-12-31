<template>
    <jet-button @click="printTags">Print Tags</jet-button>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        JetButton,
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
