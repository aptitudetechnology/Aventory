<template>
    <div>
        <jet-section-title>
            <template #title>Discounts</template>
        </jet-section-title>

        <div class="divide-gray-50 divide-y">
            <discount-item
                v-for="discount in discounts"
                :key="discount.id"
                :discount="discount"
            />
        </div>
        <create-order-discount
            class="mt-4 ml-auto flex justify-end"
            :order="order"
        />
    </div>
</template>
<script>
import DiscountItem from "./DiscountItem";
import CreateOrderDiscount from "./DiscountCreate";

export default {
    name: "Discounts",
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    components: {
        DiscountItem,
        CreateOrderDiscount,
    },
    data() {
        return {
            discounts: [],
        };
    },
    mounted() {
        this.getDiscounts();
    },
    watch: {
        order: {
            handler() {
                this.$nextTick(() => {
                    this.getDiscounts();
                });
            },
            deep: true,
        },
    },
    methods: {
        async getDiscounts() {
            await axios
                .get(
                    route("orders.discounts.index", {
                        order: this.order.id,
                    })
                )
                .then((response) => {
                    this.discounts = response.data;
                })
                .catch((error) => {
                    console.error(error.response.data.message);
                });
        },
    },
};
</script>
