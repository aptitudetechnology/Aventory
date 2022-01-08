<template>
    <inertia-link :href="href" class="btn">
        <slot></slot>
    </inertia-link>
</template>

<script>
export default {
    props: {
        href: {
            type: String,
            default: "#",
        },
    },
};
</script>
