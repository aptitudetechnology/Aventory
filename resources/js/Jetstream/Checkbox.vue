<template>
    <input
        type="checkbox"
        :value="value"
        :disabled="disabled"
        :checked="checked"
        v-model="proxyChecked"
        :class="[
            'rounded border-gray-300 shadow-sm focus:border-none focus:ring-1 focus:ring-current focus:ring-opacity-50 cursor-pointer',
            'text-' + color + '-600',
        ]"
    />
</template>

<script>
export default {
    emits: ["update:checked"],

    props: {
        color: {
            default: "green",
            type: String,
        },
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        value: {
            default: null,
        },
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
};
</script>
