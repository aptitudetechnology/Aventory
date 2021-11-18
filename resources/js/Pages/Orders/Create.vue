<template>
    <orders-layout>
        <create-order-form
            :customers="customers"
            class="max-w-screen-lg mx-auto"
        />
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
    props: ["customers"],
};
</script>
