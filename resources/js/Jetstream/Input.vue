<template>
    <input
        class="input input-bordered"
        :class="{
            ' input-error': error,
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
