<template>
    <RadioGroup v-model="selected">
        <RadioGroupLabel class="sr-only"> {{ label }} </RadioGroupLabel>
        <div class="bg-white rounded-md -space-y-px">
            <RadioGroupOption
                as="template"
                v-for="(option, optionIndex) in options"
                :key="option[keyValue]"
                :value="option"
                v-slot="{ checked, active }"
            >
                <div
                    :class="[
                        optionIndex === 0 ? 'rounded-tl-md rounded-tr-md' : '',
                        optionIndex === options.length - 1
                            ? 'rounded-bl-md rounded-br-md'
                            : '',
                        checked
                            ? 'bg-indigo-50 border-indigo-200 z-10'
                            : 'border-gray-200',
                        'relative border p-4 flex cursor-pointer focus:outline-none',
                    ]"
                >
                    <span
                        :class="[
                            checked
                                ? 'bg-indigo-600 border-transparent'
                                : 'bg-white border-gray-300',
                            active
                                ? 'ring-2 ring-offset-2 ring-indigo-500'
                                : '',
                            'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center',
                        ]"
                        aria-hidden="true"
                    >
                        <span class="rounded-full bg-white w-1.5 h-1.5" />
                    </span>
                    <div class="ml-3 flex flex-col">
                        <RadioGroupLabel
                            as="span"
                            :class="[
                                checked ? 'text-indigo-900' : 'text-gray-900',
                                'block text-sm font-medium',
                            ]"
                        >
                            {{ option[nameValue] }}
                        </RadioGroupLabel>
                        <RadioGroupDescription
                            as="span"
                            :class="[
                                checked ? 'text-indigo-700' : 'text-gray-500',
                                'block text-sm',
                            ]"
                        >
                            {{ option[descriptionValue] }}
                        </RadioGroupDescription>
                    </div>
                </div>
            </RadioGroupOption>
        </div>
    </RadioGroup>
</template>

<script>
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";

export default {
    components: {
        RadioGroup,
        RadioGroupDescription,
        RadioGroupLabel,
        RadioGroupOption,
    },
    props: {
        label: {
            type: String,
            default: "Select Option",
        },
        nameValue: {
            type: String,
            default: "name",
        },
        descriptionValue: {
            type: String,
            default: "description",
        },
        keyValue: {
            type: String,
            default: "id",
        },
        options: {
            type: [Array, Boolean],
            default: [],
        },
        selectedItem: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            selected: this.selectedItem,
        };
    },
    watch: {
        selected(newValue) {
            this.$emit("update", newValue);
        },
    },
};
</script>
