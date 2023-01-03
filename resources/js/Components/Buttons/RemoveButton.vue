<template>
    <button class="hover:opacity-50 transition p-2">
        <DocumentMinusIcon
            :class="('stroke-current', ['w-' + size, 'h-' + size])"
        />
    </button>
</template>

<script>
import { DocumentMinusIcon } from "@heroicons/vue/20/solid";
export default {
    props: { size: { default: 4 } },
    components: {
        DocumentMinusIcon,
    },
};
</script>
