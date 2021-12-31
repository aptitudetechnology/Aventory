<template>
    <orders-layout>
        <div class="lg:flex">
            <div class="lg:w-3/4 lg:mr-6">
                <OrderUpdate
                    :order="order"
                    :customers="customers"
                    :priceLevels="priceLevels"
                />
            </div>
            <div class="lg:w-1/4 mt-4 lg:mt-0 space-y-4">
                <inventory-add :order="order" class="" />
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
    data() {
        return {
            editingInventory: false,
        };
    },
};
</script>
