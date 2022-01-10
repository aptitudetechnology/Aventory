<template>
    <QuotesLayout>
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
    </QuotesLayout>
</template>

<script>
import QuotesLayout from "./QuotesLayout.vue";
import OrderUpdate from "@/Pages/Orders/Components/OrderUpdate";
import OrderDelete from "@/Pages/Orders/Components/OrderDelete.vue";
import InventoryAdd from "@/Pages/Orders/Components/InventoryAdd.vue";
import ActionCard from "@/Pages/Orders/Components/ActionCard.vue";

export default {
    components: {
        QuotesLayout,
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
