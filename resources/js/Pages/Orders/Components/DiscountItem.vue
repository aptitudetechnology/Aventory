<template>
    <div
        class="
            relative
            md:flex md:space-x-6
            py-4
            px-4
            items-center
            justify-between
            cursor-pointer
            hover:bg-gray-50
        "
    >
        <div class="flex items-center w-full md:w-auto">
            <div class="ml-6 w-full md:w-auto">
                <div title="Discount Description" class="text-lg">
                    {{ updatedDiscount.description }}
                </div>
            </div>
        </div>
        <div
            class="
                flex flex-row-reverse
                justify-between
                w-full
                md:w-auto md:flex-col md:items-end
                pl-10
                md:pl-0 md:text-right
            "
        >
            <div title="Discount Total" class="text-lg">
                {{ formatMoney(updatedDiscount.discount_total) }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        discount: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            updatedDiscount: this.$inertia.form(this.discount),
        };
    },
    watch: {
        discount() {
            this.updatedDiscount = this.$inertia.form(this.discount);
        },
    },
    methods: {
        updateItem() {
            this.updatedDiscount.patch(
                route("orders.discounts.update", [
                    this.discount.order_id,
                    this.discount.id,
                ])
            );
        },
    },
};
</script>
