<template>
    <button class="hover:opacity-50 transition p-2">
        <TrashIcon :class="('stroke-current', ['w-' + size, 'h-' + size])" />
    </button>
</template>

<script>
import { TrashIcon } from "@heroicons/vue/24/outline";
export default {
    props: { size: { default: 4 } },
    components: {
        TrashIcon,
    },
};
</script>
