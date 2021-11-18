<template>
    <component :is="as" :class="classes"><slot></slot></component>
</template>
<script>
export default {
    props: {
        current: Boolean,
        type: { type: String, default: "underline" },
        as: { type: String, default: "inertia-link" },
    },
    computed: {
        classes() {
            if (this.type == "pill") {
                return [
                    this.current
                        ? "bg-gray-100 text-gray-700"
                        : "text-gray-500 hover:text-gray-700",
                    "px-3 py-2 font-medium text-sm rounded-md",
                ];
            } else if (this.type == "underline") {
                return [
                    this.current ? "border-green-500" : "border-gray-100",
                    "p-3 border-b border-gray-100 text-gray-500 hover:text-gray-700 hover:border-gray-300",
                ];
            }
        },
    },
};
</script>
