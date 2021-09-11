<template>
    <button class="hover:opacity-50 transition p-2">
        <DeleteIcon :class="('stroke-current', ['w-' + size, 'h-' + size])" />
    </button>
</template>

<script>
import DeleteIcon from "@heroicons/vue/outline/TrashIcon";
export default {
    props: { size: { default: 4 } },
    components: {
        DeleteIcon,
    },
};
</script>
