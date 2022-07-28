<template>
    <orders-layout>
        <OrderCreate :customers="customers" />
    </orders-layout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";

import OrderCreate from "./Components/OrderCreate.vue";
export default {
    components: {
        OrdersLayout,
        OrderCreate,
    },
    props: ["customers"],
};
</script>
