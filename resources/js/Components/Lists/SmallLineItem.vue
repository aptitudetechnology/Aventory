<template>
    <component
        :is="as"
        class="flex items-center justify-between hover:bg-gray-100 uppercase text-sm p-2 cursor-pointer"
    >
        <slot></slot>
    </component>
</template>
<script>
export default {
    props: {
        as: {
            type: String,
            default: "div",
        },
    },
};
</script>
