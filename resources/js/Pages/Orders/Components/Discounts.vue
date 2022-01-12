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
            <loading-state :loading="loading"></loading-state>
            <discount-item
                v-for="discount in discounts"
                :key="discount.id"
                :discount="discount"
            />
            <div v-if="!discounts.length" class="text-center text-gray-500 p-4">
                No discounts applied.
            </div>
        </div>
    </div>
</template>
<script>
import DiscountItem from "./DiscountItem";
import CreateOrderDiscount from "./DiscountCreate";
import LoadingState from "@/Components/LoadingState";
export default {
    name: "Discounts",
    components: {
        DiscountItem,
        CreateOrderDiscount,
        LoadingState,
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
            loading: true,
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
        getDiscounts() {
            axios
                .get(
                    route("sales.discounts.index", {
                        sale: this.order.id,
                    })
                )
                .then((response) => {
                    this.discounts = response.data;
                })
                .catch((error) => {
                    console.error(error.response.data.message);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
