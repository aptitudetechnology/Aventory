<template>
    <QueueLayout>
        <div class="flex justify-between items-center w-full pb-9 px-2 lg:px-4">
            <heading-one>Inventory to Print</heading-one>
            <add-to-queue></add-to-queue>
        </div>
        <div class="grid gap-6 lg:gap-8">
            <QueueView :filters="filters" :inventory="queue" />
        </div>
    </QueueLayout>
</template>

<script>
import QueueLayout from "./QueueLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink";
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import QueueView from "./Components/QueueView.vue";
import AddToQueue from "./Components/AddToQueue.vue";
export default {
    components: {
        QueueLayout,
        ButtonLink,
        HeadingOne,
        QueueView,
        AddToQueue,
    },
    props: {
        queue: {
            type: [Object, Array],
        },
        filters: {
            type: Object,
        },
    },
};
</script>
