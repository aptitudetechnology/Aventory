<template>
    <div
        v-if="show"
        class="flex flex-wrap items-center px-4 lg:px-0 fixed z-50 top-20 right-4 sm:right-6 lg:static"
    >
        <div
            v-if="order.items.length > 0"
            class="dropdown dropdown-hover dropdown-end mr-2"
        >
            <PrintButton class="bg-white">Print</PrintButton>
            <ul
                tabindex="0"
                class="shadow menu dropdown-content bg-base-100 rounded-lg text-right w-52"
            >
                <li>
                    <a
                        @click="printOrder"
                        class="justify-end px-4 capitalize"
                        >{{ order.type }}</a
                    >
                </li>
                <li>
                    <a @click="printPickTicket" class="justify-end px-4"
                        >Pick Ticket</a
                    >
                </li>
            </ul>
        </div>
        <convert-sale :order="order" />
    </div>
</template>

<script>
import PrintButton from "@Components/Buttons/PrintButton.vue";
import ConvertSale from "@/Pages/Orders/Components/ConvertSale.vue";
export default {
    components: {
        PrintButton,
        ConvertSale,
    },
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    computed: {
        show() {
            return true;
        },
    },

    methods: {
        printOrder() {
            this.showPopup(route("orders.print", this.order.id), "Print");
        },
        printPickTicket() {
            this.showPopup(
                route("orders.print", {
                    sale: this.order,
                    template: "pick_ticket",
                }),
                "Print"
            );
        },
    },
};
</script>
