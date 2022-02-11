<template>
    <Link :href="href" class="btn">
        <slot></slot>
    </Link>
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
