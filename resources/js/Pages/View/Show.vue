<template>
    <products-layout>
        <template #nav> </template>
    </products-layout>
</template>
<script>
import JetButton from "@/Jetstream/Button.vue";

export default {
    components: {
        JetButton,
    },
    props: ["product"],
};
</script>
