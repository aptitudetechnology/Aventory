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
        type="text"
        v-model="displayValue"
        @focus="isInputFocused = true"
        @blur="isInputFocused = false"
        :min="min"
        :max="max"
        ref="input"
    />
</template>

<script>
export default {
    props: ["modelValue", "min", "max"],

    emits: ["update:modelValue"],
    data() {
        return {
            isInputFocused: false,
        };
    },
    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
    computed: {
        displayValue: {
            get: function () {
                if (this.isInputFocused) {
                    return this.modelValue.toString();
                } else {
                    return this.modelValue
                        ? this.formatMoney(this.modelValue)
                        : "$0.00";
                }
            },
            set: function (modifiedValue) {
                let newValue = parseFloat(
                    modifiedValue.replace(/[^\d\.]/g, "")
                );
                if (isNaN(newValue)) {
                    newValue = 0;
                }
                this.$emit("update:modelValue", newValue);
            },
        },
    },
};
</script>
