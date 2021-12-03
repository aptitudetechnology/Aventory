<template>
    <div class="md:flex space-x-6 gap-4 py-4 items-end justify-between">
        <div class="flex items-center">
            <jet-label class="sr-only" :for="'item-selected' + form.id"
                >Select</jet-label
            >
            <jet-check-box
                :id="'item-selected' + form.id"
                @change="$emit('selected')"
                :value="form.id"
                v-model="selected"
                :checked="selected"
            ></jet-check-box>
            <div class="ml-6">
                <div title="Product Name" class="text-lg mb-2">
                    {{ form.product_name }}
                </div>
                <div class="grid gap-4 grid-cols-2 mr-auto">
                    <div
                        class="text-sm tracking-wider uppercase"
                        title="Product Size"
                    >
                        {{ form.size_name }} @
                        {{ formatMoney(form.unit_price) }}
                    </div>
                    <div
                        class="
                            px-1
                            text-sm text-gray-500
                            tracking-wider
                            uppercase
                        "
                        title="Quantity Confirmed"
                    >
                        Qt: {{ form.quantity }}
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-end justify-items-end">
            <div title="Line Total" class="">
                {{ formatMoney(form.line_total) }}
            </div>
            <div class="flex items-center">
                <div class="px-2 flex items-center">
                    <label
                        class="
                            px-1
                            pr-2
                            text-xs text-gray-500
                            tracking-wider
                            uppercase
                        "
                        :for="'no_discount' + form.id"
                        >No Discount
                    </label>
                    <jet-check-box
                        :id="'no_discount' + form.id"
                        @change="updateItem"
                        v-model="form.no_discount"
                        color="gray"
                        :checked="form.no_discount"
                    ></jet-check-box>
                </div>
                <DeleteOrderItem :item="item" />

                <edit-order-item
                    title="Edit"
                    :orderItem="item"
                ></edit-order-item>
            </div>
        </div>
    </div>
</template>

<script>
import Check from "@heroicons/vue/outline/CheckIcon";
import JetCheckBox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";

import EditOrderItem from "./EditOrderItem.vue";
import DeleteOrderItem from "./DeleteOrderItem.vue";
export default {
    components: {
        Check,

        JetCheckBox,
        JetLabel,

        EditOrderItem,
        DeleteOrderItem,
    },
    props: {
        item: Object,
        itemSelected: Boolean,
    },
    data() {
        return {
            selected: this.itemSelected,
            form: this.$inertia.form(this.item),
        };
    },

    watch: {
        itemSelected() {
            this.selected = this.itemSelected;
        },
    },
    methods: {
        updateItem() {
            this.form.patch(
                route("order-items.update", [this.item.order_id, this.item.id])
            );
        },
    },
};
</script>
