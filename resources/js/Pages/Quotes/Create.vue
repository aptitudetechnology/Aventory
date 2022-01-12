<template>
    <quotes-layout>
        <OrderCreate
            :is-quote="true"
            :customers="customers"
            class="max-w-screen-lg mx-auto"
        />
    </quotes-layout>
</template>

<script>
import QuotesLayout from "./QuotesLayout.vue";

import OrderCreate from "@/Pages/Orders/Components/OrderCreate";
export default {
    components: {
        QuotesLayout,
        OrderCreate,
    },
    props: ["customers"],
};
</script>
