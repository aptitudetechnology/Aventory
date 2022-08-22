<template>
    <Link
        :href="href"
        :class="[
            current ? 'bg-gray-50' : 'hover:bg-gray-50 hover:text-gray-900',
            'text-gray-700 text-large group flex items-center px-2 py-2 text-base rounded-md',
        ]"
    >
        <slot></slot>
    </Link>
</template>

<script>
export default {
    props: ["href", "current"],
};
</script>
