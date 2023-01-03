<template>
    <button
        class="-ml-1 inline-flex items-center space-x-3 text-sm text-blue-gray-900"
    >
        <ChevronLeftIcon
            class="h-5 w-5 text-blue-gray-400"
            aria-hidden="true"
        />
        <span><slot></slot></span>
    </button>
</template>
<script>
import { ChevronLeftIcon } from "@heroicons/vue/20/solid";

export default {
    components: { ChevronLeftIcon },
};
</script>
