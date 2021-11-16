<template>
    <orders-layout>
        <create-order-form class="max-w-screen-lg mx-auto" />
    </orders-layout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";

import CreateOrderForm from "./Components/CreateOrderForm";
export default {
    components: {
        OrdersLayout,
        CreateOrderForm,
    },
};
</script>
