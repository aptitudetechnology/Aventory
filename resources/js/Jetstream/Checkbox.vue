<template>
    <input
        type="checkbox"
        :value="value"
        :disabled="disabled"
        :checked="checked"
        v-model="proxyChecked"
        class="checkbox checkbox-sm"
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
