<template>
    <label class="label">
        <span class="label-text" v-if="value">{{ value }}</span>
        <span class="label-text" v-else><slot></slot></span>
    </label>
</template>

<script>
export default {
    props: ["value"],
};
</script>
