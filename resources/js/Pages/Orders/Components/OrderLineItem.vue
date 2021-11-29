<template>
    <div class="grid gap-4 grid-cols-5 md:grid-cols-10 py-2 items-center">
        <div class="col-span-2 md:col-span-4 flex items-center">
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
            <div title="Product Name" class="ml-6 truncate">
                {{ form.product_name }}
            </div>
        </div>

        <div
            class="px-1 text-sm text-gray-500 tracking-wider uppercase"
            title="Product Size"
        >
            {{ form.size_name }}
        </div>
        <div
            class="px-1 text-sm text-gray-500 tracking-wider uppercase"
            title="Quantity Confirmed"
        >
            {{ form.quantity }}
        </div>

        <div
            class="px-1 text-sm text-gray-500 tracking-wider uppercase"
            title="Unit Price"
        >
            $ {{ form.unit_price }}
        </div>
        <div class="px-1 md:block">
            <jet-label class="sr-only" :for="'item-recieved' + form.id"
                >No Discount</jet-label
            >
            <jet-check-box
                :id="'item-recieved' + form.id"
                @change="itemReceived"
                v-model="form.received"
                color="gray"
                :checked="form.received"
            ></jet-check-box>
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
        itemReceived() {
            this.form.patch(route("order-item.update", this.item));
        },
    },
};
</script>
