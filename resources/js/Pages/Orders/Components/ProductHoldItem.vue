<template>
    <div
        @click="viewOrder"
        class="
            flex
            items-center
            justify-between
            hover:bg-gray-100
            uppercase
            text-sm
            p-2
        "
    >
        <div class="text-black">
            {{ item.is_quote ? "Quote #" : "Order #" }} {{ item.order_id }},
            {{ item.order.customer.name }}
        </div>
        <div>Qt:{{ item.quantity }}</div>
    </div>
</template>
<script>
export default {
    props: {
        item: {
            type: Object,
        },
    },
    methods: {
        viewOrder() {
            this.showPopup(
                route("orders.show", this.item.order_id),
                "View Order"
            );
        },
    },
};
</script>
