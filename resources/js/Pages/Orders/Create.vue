<template>
    <orders-layout>
        <create-order-form />
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
