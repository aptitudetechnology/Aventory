<template>
    <OrdersLayout>
        <div class="lg:flex">
            <div class="lg:w-3/4 lg:mr-6">
                <OrderUpdate
                    :order="order"
                    :customers="customers"
                    :priceLevels="priceLevels"
                />
            </div>
            <div class="lg:w-1/4 mt-4 lg:mt-0 space-y-4">
                <ActionCard :order="order" />
                <InventoryAdd :order="order" class="" />
                <OrderDelete :order="order" />
            </div>
        </div>
    </OrdersLayout>
</template>

<script>
import OrdersLayout from "./OrdersLayout.vue";
import OrderUpdate from "./Components/OrderUpdate";
import OrderDelete from "./Components/OrderDelete.vue";
import InventoryAdd from "./Components/InventoryAdd.vue";
import ActionCard from "./Components/ActionCard.vue";

export default {
    components: {
        OrdersLayout,
        OrderUpdate,
        OrderDelete,
        InventoryAdd,
        ActionCard,
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
