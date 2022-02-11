<template>
    <component :is="as" :class="classes"><slot></slot></component>
</template>
<script>
export default {
    props: {
        current: Boolean,
        type: { type: String, default: "underline" },
        as: { type: String, default: "Link" },
    },
    computed: {
        classes() {
            if (this.type == "pill") {
                return [this.current ? "tab-active" : "", "tab"];
            } else if (this.type == "underline") {
                return [this.current ? "tab-active" : "", "tab tab-bordered"];
            }
        },
    },
};
</script>
