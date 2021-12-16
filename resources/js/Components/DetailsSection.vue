<template>
    <div>
        <div
            class="px-4 py-5 bg-white sm:p-6 shadow"
            :class="
                hasActions
                    ? 'sm:rounded-tl-md sm:rounded-tr-md'
                    : 'sm:rounded-md'
            "
        >
            <div class="grid grid-cols-6 gap-4">
                <jet-section-title
                    class="col-span-6 mb-0"
                    v-if="hasTitle"
                    :showBorder="showTitleBorder"
                >
                    <template #title><slot name="title"></slot></template>
                    <template #description
                        ><slot name="description"></slot
                    ></template>
                    <template #aside><slot name="aside" /></template>
                </jet-section-title>
                <slot></slot>
            </div>
        </div>

        <div
            class="
                flex
                items-center
                justify-end
                px-4
                py-3
                bg-gray-50
                text-right
                sm:px-6
                shadow
                sm:rounded-bl-md sm:rounded-br-md
            "
            v-if="hasActions"
        >
            <slot name="actions"></slot>
        </div>
    </div>
</template>

<script>
import JetSectionTitle from "@/Jetstream/SectionTitle";

export default {
    components: {
        JetSectionTitle,
    },
    props: {
        showTitleBorder: {
            type: Boolean,
            default: true,
        },
    },

    computed: {
        hasActions() {
            return !!this.$slots.actions;
        },
        hasTitle() {
            return !!this.$slots.title;
        },
    },
};
</script>
