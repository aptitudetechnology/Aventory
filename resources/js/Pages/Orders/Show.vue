<template>
    <orders-layout>
        <div>
            <div class="space-y-6">
                <update-order-form :order="order" />
                <order-items :order="order" :orderItems="orderItems" />
                <delete-order-form :order="order" />
            </div>
        </div>
    </orders-layout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink";

import UpdateOrderForm from "./Components/UpdateOrderForm";
import DeleteOrderForm from "./Components/DeleteOrderForm.vue";
import OrderItems from "./Components/OrderItems.vue";
export default {
    components: {
        OrdersLayout,
        UpdateOrderForm,
        ButtonLink,
        DeleteOrderForm,
        OrderItems,
    },
    props: {
        order: Object,
        orderItems: Array,
    },
};
</script>
