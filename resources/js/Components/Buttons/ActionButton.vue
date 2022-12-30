<template>
    <button class="btn btn-sm btn-outline pl-2 flex items-center">
        <SparklesIcon class="w-4 h-4 stroke-current mr-2" />

        <slot />
    </button>
</template>

<script>
import { SparklesIcon } from "@heroicons/vue/20/solid";
export default {
    components: {
        SparklesIcon,
    },
};
</script>
