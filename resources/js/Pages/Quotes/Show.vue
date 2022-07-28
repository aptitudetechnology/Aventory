<template>
    <QuotesLayout>
        <div class="lg:flex">
            <div class="lg:w-3/4 lg:mr-6">
                <OrderUpdate
                    :order="quote"
                    :customers="customers"
                    :priceLevels="priceLevels"
                />
            </div>
            <div class="lg:w-1/4 mt-4 lg:mt-0 space-y-4">
                <ActionCard :order="quote" />
                <LinkedOrdersCard :quote="quote" />
                <OrderDelete :order="quote" />
            </div>
        </div>
    </QuotesLayout>
</template>

<script>
import QuotesLayout from "./QuotesLayout.vue";
import OrderUpdate from "@/Pages/Orders/Components/OrderUpdate.vue";
import OrderDelete from "@/Pages/Orders/Components/OrderDelete.vue";
import ActionCard from "@/Pages/Orders/Components/ActionCard.vue";
import LinkedOrdersCard from "@/Pages/Quotes/Components/LinkedOrdersCard.vue";

export default {
    components: {
        QuotesLayout,
        OrderUpdate,
        OrderDelete,
        ActionCard,
        LinkedOrdersCard,
    },
    props: {
        quote: Object,
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
