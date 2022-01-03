<template>
    <div class="">
        <div v-for="orderItem in inventory" :key="orderItem.id" class="min-w-0">
            <div
                class="
                    flex
                    items-center
                    space-x-2
                    tracking-wider
                    uppercase
                    text-gray-900
                    px-1
                    my-2
                    py-2
                    border-b border-t
                    min-w-0
                "
            >
                <div
                    :data-tip="`${
                        orderItem.is_matched
                            ? 'Matched to Inventory: '
                            : 'NOT Matched to Inventory: '
                    }${orderItem.size_name} - ${orderItem.product_name}`"
                    class="mr-0 tooltip tooltip-right md:tooltip-bottom"
                >
                    <CheckCircleIcon
                        class="w-6 h-6 text-green-500 stroke-current mr-0"
                        v-if="orderItem.is_matched"
                    />
                    <ExclamationCircleIcon
                        class="w-6 h-6 text-yellow-500 stroke-current mr-0"
                        v-else
                    />
                </div>

                <div class="truncate w-1/2 ml-0">
                    {{ orderItem.size_name }} -
                    {{ orderItem.product_name }}
                </div>
                <div class="">
                    {{ `Qty: ${orderItem.quantity}` }}
                </div>
            </div>
            <div class="flex flex-wrap">
                <inventory-item
                    v-for="archivedItem in orderItem.archived_inventory"
                    :key="archivedItem.id"
                    :archivedItem="archivedItem"
                    :order="order"
                    :quantity_left="orderItem.unmatched_quantity"
                />
                <div
                    v-if="!orderItem.archived_inventory.length"
                    class="px-1 py-1 text-sm text-gray-700"
                >
                    No Inventory matched.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ExclamationCircleIcon, CheckCircleIcon } from "@heroicons/vue/outline";
import InventoryItem from "./InventoryItem.vue";
export default {
    components: {
        ExclamationCircleIcon,
        CheckCircleIcon,
        InventoryItem,
    },
    props: {
        inventory: {
            type: Object,
            required: true,
        },
        order: {
            type: Object,
            required: true,
        },
    },
};
</script>
