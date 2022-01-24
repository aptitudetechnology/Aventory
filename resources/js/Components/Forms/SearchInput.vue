<template>
    <div class="flex space-x-4">
        <div class="flex-1 min-w-0">
            <label for="search" class="sr-only">Search</label>
            <div class="relative rounded-md shadow-sm">
                <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                    <SearchIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </div>
                <jet-input
                    :value="modelValue"
                    @input="$emit('update:modelValue', $event.target.value)"
                    ref="input"
                    :type="type"
                    v-bind="$attrs"
                    name="search"
                    id="search"
                    :inputmode="inputmode"
                    :pattern="pattern"
                    :title="title"
                    :autocomplete="autocomplete"
                    :disabled="disabled"
                    class="w-full pl-10"
                    :placeholder="placeholder"
                />
            </div>
        </div>
    </div>
</template>

<script>
import JetInput from "@/Jetstream/Input.vue";
import SearchIcon from "@heroicons/vue/solid/SearchIcon";

export default {
    components: {
        JetInput,
        SearchIcon,
    },
    props: {
        modelValue: String,
        placeholder: { type: String, default: "Search" },
        autofocus: { type: Boolean, default: false },
        autocomplete: { type: String, default: "off" },
        type: { type: String, default: "search" },
        pattern: { type: String },
        inputmode: { type: String },
        disabled: { type: Boolean, default: false },
        title: {
            type: String,
            default: "Search",
        },
    },

    emits: ["update:modelValue"],
    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
    updated() {
        if (this.autofocus) {
            this.focus();
        }
    },
    mounted() {
        if (this.autofocus) {
            this.focus();
        }
    },
};
</script>

<style scoped>
input[type="search"]::-webkit-search-cancel-button {
    cursor: pointer;
    -webkit-appearance: none;
    padding: 0.5em;
    height: 1.5em;
    width: 1.5em;
    border-radius: 50em;
    background: url(https://pro.fontawesome.com/releases/v5.10.0/svgs/solid/times-circle.svg)
        no-repeat 50% 50%;
    background-size: 50%;
    opacity: 0;
    pointer-events: none;
}

input[type="search"]:focus::-webkit-search-cancel-button {
    opacity: 0.3;
    pointer-events: all;
}
</style>
