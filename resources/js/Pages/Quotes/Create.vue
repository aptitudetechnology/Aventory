<template>
    <quotes-layout>
        <OrderCreate :is-quote="true" :customers="customers" />
    </quotes-layout>
</template>

<script>
import QuotesLayout from "./QuotesLayout.vue";

import OrderCreate from "@/Pages/Orders/Components/OrderCreate.vue";
export default {
    components: {
        QuotesLayout,
        OrderCreate,
    },
    props: ["customers"],
};
</script>
