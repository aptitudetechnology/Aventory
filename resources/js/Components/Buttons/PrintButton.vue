<template>
    <button class="btn btn-sm btn-outline flex items-center">
        <PrinterIcon class="w-6 h-6 stroke-current mr-2" />
        <slot />
    </button>
</template>

<script>
import { PrinterIcon } from "@heroicons/vue/outline";
export default {
    components: {
        PrinterIcon,
    },
};
</script>
