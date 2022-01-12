<template>
    <LineItem @click="editing = true">
        <div class="flex items-center w-full md:w-auto">
            <div @click.stop class="flex items-center h-full hidden">
                <jet-label class="sr-only" :for="'item-selected' + form.id"
                    >Select</jet-label
                >
                <jet-checkbox
                    :id="'item-selected' + form.id"
                    @change="$emit('selected')"
                    :value="form.id"
                    v-model="selected"
                    :checked="selected"
                ></jet-checkbox>
            </div>
            <div class="w-full md:w-auto">
                <div title="Product Name" class="card-title mb-2">
                    {{ form.product_name }}
                </div>
                <div
                    class="flex items-end flex-row-reverse md:flex-row md:-ml-2 flex-wrap w-full md:w-auto"
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
                        @hover.stop
                        class="md:px-2 flex items-center py-1 mr-auto"
                    >
                        <jet-label
                            class="px-0 pr-2 py-0 text-gray-700 uppercase tracking-wide"
                            :for="'no_discount' + form.id"
                            >No Discount
                        </jet-label>
                        <jet-checkbox
                            :id="'no_discount' + form.id"
                            @change="updateItem"
                            v-model="form.no_discount"
                            color="gray"
                            :checked="form.no_discount"
                        ></jet-checkbox>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="flex flex-row-reverse justify-between w-full md:w-auto md:flex-col md:items-end pl-10 md:pl-0 md:text-right"
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
    </LineItem>
</template>

<script>
import Check from "@heroicons/vue/outline/CheckIcon";
import LineItem from "@Components/Lists/LineItem.vue";
import EditOrderItem from "./ItemEdit.vue";
import DeleteOrderItem from "./ItemDelete.vue";
export default {
    components: {
        Check,
        LineItem,
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
                route("sales.order-items.update", [
                    this.item.order_id,
                    this.item.id,
                ])
            );
        },
    },
};
</script>
