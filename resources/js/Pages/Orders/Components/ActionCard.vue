<template>
    <div
        class="
            flex
            items-center
            px-4
            lg:px-0
            fixed
            top-20
            right-0
            sm:right-4
            lg:static
        "
    >
        <div class="dropdown dropdown-hover dropdown-end z-20">
            <PrintButton class="mr-2 bg-white">Print</PrintButton>
            <ul
                tabindex="0"
                class="shadow menu dropdown-content bg-base-100 rounded-lg w-52"
            >
                <li>
                    <a @click="printOrder">Order</a>
                </li>
                <li>
                    <a @click="printPickTicket">Pick Ticket</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import PrintButton from "@Components/Buttons/PrintButton.vue";

export default {
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    components: {
        PrintButton,
    },
    methods: {
        printOrder() {
            this.showPopup(route("orders.print", this.order.id), "Print");
        },
        printPickTicket() {
            this.showPopup(
                route("orders.print", {
                    order: this.order,
                    template: "pick_ticket",
                }),
                "Print"
            );
        },
    },
};
</script>
