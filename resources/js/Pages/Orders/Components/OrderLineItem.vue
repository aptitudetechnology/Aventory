<template>
    <div
        @click="editing = true"
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
            <div @click.stop class="flex items-center h-full">
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
            </div>
            <div class="ml-6 w-full md:w-auto">
                <div title="Product Name" class="text-lg">
                    {{ form.product_name }}
                </div>
                <div
                    class="
                        flex
                        items-end
                        flex-row-reverse
                        md:flex-row md:-ml-2
                        flex-wrap
                        w-full
                        md:w-auto
                    "
                >
                    <DeleteOrderItem :item="item" />

                    <edit-order-item
                        @close="editing = false"
                        :editing="editing"
                        title="Edit"
                        :orderItem="item"
                    ></edit-order-item>
                    <div
                        @click.stop
                        class="md:px-2 flex items-center py-1 mr-auto"
                    >
                        <label
                            class="
                                px-1
                                pr-2
                                text-sm text-gray-500
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
            <div title="Line Total" class="text-lg">
                {{ formatMoney(form.line_total) }}
            </div>
            <div
                class="flex items-center md:items-end md:justify-end flex-wrap"
            >
                <div
                    class="text-sm text-gray-500 tracking-wider uppercase"
                    title="Product Size"
                >
                    {{ form.quantity }} x
                    {{ formatMoney(form.unit_price) }}
                </div>
                <div
                    v-if="form.size"
                    class="pl-2 text-sm text-gray-500 tracking-wider uppercase"
                    title="Size"
                >
                    Size: {{ form.size_name }}
                </div>
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
            editing: false,
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
                route("orders.order-items.update", [
                    this.item.order_id,
                    this.item.id,
                ])
            );
        },
    },
};
</script>
