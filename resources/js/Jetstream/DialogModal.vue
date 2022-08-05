<template>
    <modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="px-6 py-4">
            <jet-section-title class="col-span-6">
                <template #title><slot name="title"></slot></template>
                <template #description
                    ><slot name="description"></slot
                ></template>
                <template #aside><slot name="aside"></slot></template>
            </jet-section-title>

            <div class="my-4">
                <slot name="content"> </slot>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 rounded-b-lg text-right">
            <slot name="footer"> </slot>
        </div>
    </modal>
</template>

<script>
import Modal from "./Modal.vue";
import JetSectionTitle from "./SectionTitle.vue";
export default {
    emits: ["close"],

    components: {
        Modal,
        JetSectionTitle,
    },

    props: {
        show: {
            default: false,
        },
        maxWidth: {
            default: "2xl",
        },
        closeable: {
            default: true,
        },
    },

    methods: {
        close() {
            this.$emit("close");
        },
    },
};
</script>
