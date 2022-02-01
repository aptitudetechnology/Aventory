<template>
    <input
        class="input input-bordered"
        :class="{
            ' input-error': error,
        }"
        v-bind="$attrs"
        :min="min"
        :max="max"
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
        min: { type: Number },
        max: { type: Number },
    },

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>
