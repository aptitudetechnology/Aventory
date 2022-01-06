<template>
    <div class="relative">
        <jet-input
            type="number"
            v-model="displayValue"
            @focus="isInputFocused = true"
            @blur="isInputFocused = false"
            v-bind="$attrs"
            ref="input"
            class="pr-6 w-full"
        />
        <div class="absolute top-0 bottom-0 right-0 pr-2 flex items-center">
            %
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: [Number, String],
            default: 0,
        },
    },

    emits: ["update:modelValue"],
    data() {
        return {
            isInputFocused: false,
        };
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
