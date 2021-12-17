<template>
    <div>
        <jet-section-title>
            <template #title>Discounts</template>
            <template #aside
                ><create-order-discount
                    class="ml-auto flex justify-end"
                    :order="order"
                ></create-order-discount
            ></template>
        </jet-section-title>

        <div class="divide-gray-50 divide-y">
            <discount-item
                v-for="discount in discounts"
                :key="discount.id"
                :discount="discount"
            />
        </div>
    </div>
</template>
<script>
import DiscountItem from "./DiscountItem";
import CreateOrderDiscount from "./DiscountCreate";
export default {
    name: "Discounts",
    components: {
        DiscountItem,
        CreateOrderDiscount,
    },
    props: {
        order: {
            type: Object,
            required: true,
        },
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
