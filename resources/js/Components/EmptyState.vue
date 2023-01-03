<template>
    <div
        class="p-6"
        :class="{
            'text-center': align === 'center',
            'text-right': align === 'right',
            'text-left': align === 'left',
        }"
    >
        <svg
            v-if="showIcon"
            class="mb-2 h-12 w-12 text-gray-400"
            :class="{
                'mx-auto': align === 'center',
                'ml-auto': align === 'right',
                'mr-auto': align === 'left',
            }"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path
                vector-effect="non-scaling-stroke"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"
            />
        </svg>
        <h3 class="text-sm text-gray-700">{{ heading }}</h3>
        <p class="mt-1 text-sm text-gray-500">
            {{ subtitle }}
        </p>
        <div v-if="buttonText && href" class="mt-6">
            <button-link :href="href">
                <PlusIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                {{ buttonText }}
            </button-link>
        </div>
    </div>
</template>

<script>
import { PlusIcon } from "@heroicons/vue/20/solid";
import ButtonLink from "./Links/ButtonLink.vue";
export default {
    components: {
        PlusIcon,
        ButtonLink,
    },
    props: {
        heading: String,
        subtitle: String,
        buttonText: String,
        href: String,
        align: {
            type: String,
            default: "center",
        },
        showIcon: {
            type: Boolean,
            default: true,
        },
    },
};
</script>
