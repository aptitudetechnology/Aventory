<template>
    <table-table class="text-left">
        <table-head>
            <table-h
                ><div
                    class="select-none cursor-pointer flex items-center"
                    :class="orderBy == 'id' ? 'text-gray-900' : ''"
                    @click="updateOrderBy('id')"
                >
                    Order #
                    <ArrowUpIcon
                        v-if="orderBy == 'id' && orderByDirection == 'asc'"
                        class="ml-2 w-3 h-3"
                    />
                    <ArrowDownIcon v-else class="ml-2 w-3 h-3" /></div
            ></table-h>
            <table-h
                ><div
                    class="select-none cursor-pointer flex items-center"
                    :class="orderBy == 'date' ? 'text-gray-900' : ''"
                    @click="updateOrderBy('date')"
                >
                    Date
                    <ArrowUpIcon
                        v-if="orderBy == 'date' && orderByDirection == 'asc'"
                        class="ml-2 w-3 h-3"
                    />
                    <ArrowDownIcon v-else class="ml-2 w-3 h-3" /></div
            ></table-h>
            <table-h
                ><div
                    class="select-none cursor-pointer flex items-center"
                    :class="orderBy == 'customer' ? 'text-gray-900' : ''"
                    @click="updateOrderBy('customer')"
                >
                    Customer
                    <ArrowUpIcon
                        v-if="
                            orderBy == 'customer' && orderByDirection == 'asc'
                        "
                        class="ml-2 w-3 h-3"
                    />
                    <ArrowDownIcon v-else class="ml-2 w-3 h-3" />
                </div>
            </table-h>
            <table-h>Status</table-h>
            <table-h>Total</table-h>
        </table-head>
        <tbody>
            <tr
                v-for="order in orders.data"
                :key="order.id"
                tabindex="0"
                class="
                    px-2
                    rounded-md
                    hover:bg-gray-100
                    focus:bg-gray-100
                    transition
                    cursor-pointer
                "
                @click="$inertia.get(route('orders.show', order))"
            >
                <table-d>{{ order.id }}</table-d>
                <table-d>{{ formatDate(order.date) }}</table-d>
                <table-d>{{ order.customer.name }}</table-d>
                <table-d>{{ order.deliveryStatus?.name }}</table-d>
                <table-d>{{ order.grand_total }}</table-d>
            </tr>
        </tbody>
    </table-table>
</template>

<script>
export default {
    props: {
        orders: {
            type: Object,
        },
    },
    data() {
        return {
            orderBy: "id",
            orderByDirection: "asc",
        };
    },
    methods: {
        updateOrderBy(orderBy) {
            if (this.orderBy == orderBy) {
                this.orderByDirection =
                    this.orderByDirection == "asc" ? "desc" : "asc";
            } else {
                this.orderBy = orderBy;
                this.orderByDirection = "asc";
            }
        },
    },
};
</script>
