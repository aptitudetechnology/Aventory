<template>
    <button class="hover:opacity-50 transition p-2">
        <EditIcon :class="('stroke-current', ['w-' + size, 'h-' + size])" />
    </button>
</template>

<script>
import EditIcon from "@heroicons/vue/outline/PencilIcon";
export default {
    props: { size: { default: 4 } },
    components: {
        EditIcon,
    },
};
</script>
