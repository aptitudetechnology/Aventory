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
            cursor-pointer
        "
    >
        <div v-if="itemIsNotInThisOrder" class="text-black">
            {{ item.is_quote ? "Quote #" : "Order #" }} {{ item.order_id }},
            {{ item.order.customer.name }}
        </div>
        <div v-else class="text-black">
            {{
                item.is_quote
                    ? `Quote # ${item.order_id} (This Quote)`
                    : `Order # ${item.order_id} (This Order)`
            }}
        </div>
        <div>Qt:{{ item.quantity }}</div>
    </div>
</template>
<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
        orderId: {
            type: Number,
            required: false,
        },
    },
    computed: {
        itemIsNotInThisOrder() {
            return this.item.order_id !== this.orderId;
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
