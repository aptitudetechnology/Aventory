<template>
    <div v-if="loading" class="flex justify-center items-center p-6">
        <div
            class="
                spinner-border
                animate-spin
                inline-block
                w-8
                h-8
                border-2 border-gray-700
                rounded-full
            "
        ></div>
    </div>
</template>
<script>
export default {
    props: {
        loading: Boolean,
    },
};
</script>
<style scoped>
.spinner-border {
    vertical-align: -0.125em;
    border-right-color: transparent;
}
.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
