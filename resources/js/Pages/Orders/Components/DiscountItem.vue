<template>
    <div
        @click="editing = true"
        class="relative md:flex md:space-x-6 py-4 px-2 items-center justify-between cursor-pointer hover:border-black border-b border-transparent"
    >
        <div class="flex items-center w-full md:w-auto">
            <div class="w-full md:w-auto">
                <div title="Discount Description" class="text-lg capitalize">
                    {{ updatedDiscount.description }}
                </div>
                <div @click.stop class="flex items-center h-full">
                    <jet-label
                        :for="'discount_applied' + discount.id"
                        class="px-0 text-gray-700 uppercase tracking-wide"
                        >Discount Applied</jet-label
                    >
                    <jet-checkbox
                        class="mx-1 ml-2 text-sm text-gray-500 tracking-wider uppercase"
                        :id="'discount_applied' + discount.id"
                        @change="updateItem"
                        v-model="updatedDiscount.discount_applied"
                        :checked="updatedDiscount.discount_applied"
                    ></jet-checkbox>
                </div>
            </div>
        </div>
        <edit-discount-item
            @close="editing = false"
            :show="editing"
            :discount="discount"
        />
        <div
            title="Discount Total"
            class="text-lg"
            :class="!updatedDiscount.discount_applied ? 'line-through' : ''"
        >
            {{ formatMoney(updatedDiscount.discount_total) }}
        </div>
    </div>
</template>

<script>
import EditDiscountItem from "./DiscountEdit.vue";
export default {
    props: {
        discount: {
            type: Object,
            required: true,
        },
    },
    components: {
        EditDiscountItem,
    },
    data() {
        return {
            editing: false,
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
                route("sales.discounts.update", [
                    this.discount.order_id,
                    this.discount.id,
                ])
            );
        },
    },
};
</script>
