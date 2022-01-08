<template>
    <div
        :class="[
            showBorder ? 'border-b border-gray-100 mb-4' : '',
            'flex justify-between items-center space-x-4  pb-2',
        ]"
    >
        <div>
            <h3 class="text-2xl font-bold card-title">
                <slot name="title"></slot>
            </h3>

            <p class="mt-1 text-sm text-base-content">
                <slot name="description"></slot>
            </p>
        </div>

        <div>
            <slot name="aside"></slot>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        showBorder: {
            type: Boolean,
            default: true,
        },
    },
};
</script>
