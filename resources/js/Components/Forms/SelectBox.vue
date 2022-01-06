<template>
    <Listbox as="div" class="form-control" v-model="selected">
        <ListboxLabel v-if="showLabel" class="label">
            <span class="label-text">{{ labelValue }}</span>
        </ListboxLabel>
        <div class="relative w-full">
            <ListboxButton class="input input-bordered w-full text-left">
                <span v-if="selected">{{ selected[nameValue] }}</span>
                <span v-else>Select</span>
                <span
                    class="
                        absolute
                        inset-y-0
                        right-0
                        flex
                        items-center
                        pr-2
                        pointer-events-none
                    "
                >
                    <SelectorIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </span>
            </ListboxButton>

            <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <ListboxOptions
                    class="
                        absolute
                        z-10
                        mt-1
                        w-full
                        bg-white
                        shadow-lg
                        max-h-60
                        rounded-md
                        py-1
                        text-base
                        ring-1 ring-black ring-opacity-5
                        overflow-auto
                        focus:outline-none
                        sm:text-sm
                    "
                >
                    <ListboxOption as="template">
                        <li
                            class="
                                text-gray-900
                                cursor-default
                                select-none
                                relative
                                py-2
                                pl-3
                                pr-9
                            "
                        >
                            <span class="font-normal block truncate">
                                Clear selected
                            </span>
                        </li>
                    </ListboxOption>
                    <ListboxOption
                        as="template"
                        v-for="item in items"
                        :key="item.id"
                        :value="item"
                        v-slot="{ active, selected }"
                    >
                        <li
                            :class="[
                                active
                                    ? 'text-white bg-gray-600'
                                    : 'text-gray-900',
                                'cursor-default select-none relative py-2 pl-3 pr-9',
                            ]"
                        >
                            <span
                                :class="[
                                    selected ? 'font-semibold' : 'font-normal',
                                    'block truncate',
                                ]"
                            >
                                {{ item[nameValue] }}
                            </span>

                            <span
                                v-if="selected"
                                :class="[
                                    active ? 'text-white' : 'text-gray-600',
                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                ]"
                            >
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>

<script>
import {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";

export default {
    components: {
        Listbox,
        ListboxButton,
        ListboxLabel,
        ListboxOption,
        ListboxOptions,
        CheckIcon,
        SelectorIcon,
    },
    props: {
        items: Array,
        selectedItem: Object | Boolean,
        labelValue: { type: String, default: "Select Option" },
        showLabel: { type: Boolean, default: true },
        nameValue: { type: String, default: "name" },
    },
    data: function () {
        return {
            selected: this.selectedItem,
        };
    },
    watch: {
        selectedItem() {
            this.selected = this.selectedItem;
        },
    },
};
</script>
