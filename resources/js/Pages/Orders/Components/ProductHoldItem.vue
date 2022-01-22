<template>
    <SmallLineItem @click="viewOrder">
        <div v-if="itemIsNotInThisOrder" class="text-black">
            {{ item.is_quote ? "Quote #" : "Order #" }} {{ item.order_id }},
            {{ item.sale.customer.name }}
        </div>
        <div v-else class="text-black">
            {{
                item.is_quote
                    ? `Quote # ${item.order_id} (This Quote)`
                    : `Order # ${item.order_id} (This Order)`
            }}
        </div>
        <div>Qt:{{ item.quantity }}</div>
    </SmallLineItem>
</template>
<script>
import SmallLineItem from "@/Components/Lists/SmallLineItem.vue";
export default {
    components: {
        SmallLineItem,
    },
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
            this.item.sale.is_quote
                ? this.showPopup(
                      route("quotes.show", this.item.order_id),
                      "View Order"
                  )
                : this.showPopup(
                      route("orders.show", this.item.order_id),
                      "View Order"
                  );
        },
    },
};
</script>
