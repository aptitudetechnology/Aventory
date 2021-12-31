<template>
    <label class="block text-sm font-medium text-gray-900 mr-4 cursor-pointer">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script>
export default {
    props: ["value"],
};
</script>
