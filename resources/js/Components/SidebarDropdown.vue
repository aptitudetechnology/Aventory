<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    dropdown_text: {
        type: String,
        required: true,
    },
    current: {
        type: Boolean,
        required: true,
    },
    route_name: {
        type: String,
        required: false,
    },
});

function dropdownClicked() {
    if (props.route_name) {
        Inertia.get(route(props.route_name));
    }
}
</script>

<template>
    <Disclosure
        as="div"
        class="space-y-1"
        v-slot="{ open }"
        :defaultOpen="current"
    >
        <DisclosureButton
            @click="dropdownClicked"
            :class="[
                current ? 'bg-gray-50' : 'hover:bg-gray-50 hover:text-gray-900',
                'text-gray-600 text-large group flex justify-between items-center px-2 py-2 text-base rounded-md w-full',
            ]"
        >
            {{ dropdown_text }}
            <svg
                :class="[
                    open ? 'text-gray-400 rotate-90' : 'text-gray-300',
                    'mr-2 flex-shrink-0 h-5 w-5 transform group-hover:text-gray-400 transition-colors ease-in-out duration-150',
                ]"
                viewBox="0 0 20 20"
                aria-hidden="true"
            >
                <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
            </svg>
        </DisclosureButton>
        <DisclosurePanel class="space-y-1 pl-4">
            <slot></slot>
        </DisclosurePanel>
    </Disclosure>
</template>
