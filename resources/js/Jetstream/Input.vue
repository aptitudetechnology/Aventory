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
        :value="modelValue"
        :min="min"
        :max="max"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>

<script>
export default {
    props: ["modelValue", "min", "max"],

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>
