<template>
    <button class="btn btn-sm btn-outline pl-2 flex items-center">
        <PrinterIcon class="w-6 h-6 stroke-current mr-2" />
        <slot />
    </button>
</template>

<script>
import { PrinterIcon } from "@heroicons/vue/24/outline";
export default {
    components: {
        PrinterIcon,
    },
};
</script>
