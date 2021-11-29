<template>
    <div class="flex space-x-6 gap-4 py-2 items-end justify-between">
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
                <div title="Product Name" class="truncate">
                    {{ form.product_name }}
                </div>
                <div class="flex items-center space-x-6">
                    <div
                        class="text-sm text-gray-500 tracking-wider uppercase"
                        title="Product Size"
                    >
                        Size: {{ form.size_name }}
                    </div>
                    <div
                        class="
                            px-1
                            text-sm text-gray-500
                            tracking-wider
                            uppercase
                        "
                        title="Unit Price"
                    >
                        Price: {{ form.unit_price }}
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

                    <div class="px-1 flex items-center">
                        <label
                            class="
                                px-1
                                pr-2
                                text-sm text-gray-500
                                tracking-wider
                                uppercase
                            "
                            :for="'item-recieved' + form.id"
                            >No Discount:
                        </label>
                        <jet-check-box
                            :id="'item-recieved' + form.id"
                            @change="updateItem"
                            v-model="form.no_discount"
                            color="gray"
                            :checked="form.no_discount"
                        ></jet-check-box>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex">
            <DeleteOrderItem :item="item" />

            <edit-order-item title="Edit" :orderItem="item"></edit-order-item>
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
                route("order-items.update", [this.item.order_id, this.item])
            );
        },
    },
};
</script>
