<template>
    <div class="relative">
        <input
            class="
                pl-6
                border-gray-300
                focus:outline-none
                focus:ring-1
                focus:ring-green-500
                focus:border-green-500
                rounded-md
                shadow-sm
                w-full
            "
            type="number"
            v-model="displayValue"
            @focus="isInputFocused = true"
            @blur="isInputFocused = false"
            :min="min"
            :max="max"
            ref="input"
        />
        <div class="absolute top-0 bottom-0 left-0 pl-2 flex items-center">
            $
        </div>
    </div>
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
                    return this.modelValue?.toString();
                } else {
                    return this.modelValue
                        ? this.formatDecimal(this.modelValue)
                        : 0.0;
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
    methods: {
        formatDecimal(value) {
            return parseFloat(value).toFixed(2);
        },
    },
};
</script>
