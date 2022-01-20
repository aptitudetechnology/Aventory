<template>
    <button class="btn btn-sm btn-outline pl-2 flex items-center">
        <SparklesIcon class="w-6 h-6 stroke-current mr-2" />

        <slot />
    </button>
</template>

<script>
import { SparklesIcon } from "@heroicons/vue/outline";
export default {
    components: {
        SparklesIcon,
    },
};
</script>
