<template>
    <orders-layout>
        <div class="flex">
            <div class="max-w-screen-lg md:w-3/4 md:mr-6">
                <div class="space-y-6">
                    <OrderUpdate
                        :order="order"
                        :customers="customers"
                        :priceLevels="priceLevels"
                    />

                    <OrderDelete :order="order" />
                </div>
            </div>
            <inventory-add :order="order" class="md:w-1/4" />
        </div>
    </orders-layout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink";

import OrderUpdate from "./Components/OrderUpdate";
import OrderDelete from "./Components/OrderDelete.vue";
import OrderItems from "./Components/Items.vue";
import InventoryAdd from "./Components/InventoryAdd.vue";

export default {
    components: {
        OrdersLayout,
        OrderUpdate,
        ButtonLink,
        OrderDelete,
        OrderItems,
        InventoryAdd,
    },
    props: {
        order: Object,
        items: Array,
        priceLevels: Array,
        customers: Array,
    },
};
</script>
