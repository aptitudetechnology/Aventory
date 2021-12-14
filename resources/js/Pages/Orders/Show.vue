<template>
    <orders-layout>
        <div class="max-w-screen-lg">
            <div class="space-y-6">
                <OrderUpdate
                    :order="order"
                    :customers="customers"
                    :priceLevels="priceLevels"
                />

                <OrderDelete :order="order" />
            </div>
        </div>
    </orders-layout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink";

import OrderUpdate from "./Components/OrderUpdate";
import OrderDelete from "./Components/OrderDelete.vue";
import OrderItems from "./Components/Items.vue";
export default {
    components: {
        OrdersLayout,
        OrderUpdate,
        ButtonLink,
        OrderDelete,
        OrderItems,
    },
    props: {
        order: Object,
        items: Array,
        priceLevels: Array,
        customers: Array,
    },
};
</script>
