<script setup>
import ButtonLink from "@/Components/Links/ButtonLink.vue";
</script>

<template>
    <div class="grid gap-2 lg:grid-cols-2 justify-end">
        <button-link class="btn-secondary" :href="route('quotes.create')"
            >New Quote</button-link
        >
        <button-link :href="route('orders.create')">New Order</button-link>
    </div>
</template>
