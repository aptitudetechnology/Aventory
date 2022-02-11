<template>
    <Link :href="href" :class="classes">
        <slot></slot>
    </Link>
</template>

<script>
export default {
    props: ["href", "active"],

    computed: {
        classes() {
            return this.active
                ? "inline-flex items-center px-1 pt-1 border-b-2 border-gray-400 text-sm  leading-5 text-gray-900 focus:outline-none focus:border-gray-700 transition"
                : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition";
        },
    },
};
</script>
