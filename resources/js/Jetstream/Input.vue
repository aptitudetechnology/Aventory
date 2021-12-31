<template>
    <input
        class="
            border-gray-300
            focus:outline-none
            focus:ring-1
            focus:ring-green-500
            focus:border-green-500
            rounded-md
            shadow-sm
        "
        :class="{
            'border-red-500': error,
        }"
        v-bind="$attrs"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>

<script>
export default {
    props: {
        modelValue: { type: [String, Boolean, Number] },
        error: { type: Boolean, default: false },
    },

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>
