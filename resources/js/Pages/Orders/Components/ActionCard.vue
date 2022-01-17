<template>
    <div
        v-if="show"
        class="flex space-x-2 items-center px-4 lg:px-0 fixed z-50 top-20 right-4 sm:right-6 lg:static"
    >
        <div
            v-if="order.items.length > 0"
            class="dropdown dropdown-hover dropdown-end"
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
        <button @click="convert" class="btn btn-sm">{{ convertText }}</button>
    </div>
</template>

<script>
import PrintButton from "@Components/Buttons/PrintButton.vue";

export default {
    components: {
        PrintButton,
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
        convertText() {
            return this.order.is_quote
                ? "Convert to Order"
                : "Convert to Quote";
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
        convert() {
            this.$inertia.post(route("sales.convert", this.order.id));
        },
    },
};
</script>
