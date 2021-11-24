<template>
    <div>
        <tab-container
            ><tab-link
                as="button"
                :current="viewingOnHold"
                @click="viewingOnHold = true"
                >On Hold</tab-link
            ><tab-link
                as="button"
                :current="!viewingOnHold"
                @click="viewingOnHold = false"
                >Sold</tab-link
            ></tab-container
        >
        <div>
            <div v-if="viewingOnHold">
                <div
                    v-for="order in onHoldProductQuotes"
                    :key="order.id"
                    class="flex"
                >
                    {{ order.company.name }}
                </div>
            </div>
            <div v-else>
                <div v-for="order in soldProductOrders" :key="order.id">
                    {{ order.company.name }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TabContainer from "@Components/TabContainer.vue";
import TabLink from "@Components/Links/TabLink.vue";
export default {
    components: {
        TabContainer,
        TabLink,
    },
    props: {
        product: {
            type: Object | Boolean,
            required: false,
        },
    },
    data() {
        return {
            onHoldProductQuotes: [],
            soldProductOrders: [],
            viewingOnHold: true,
        };
    },
    watch: {
        product(product) {
            if (product) {
                axios
                    .get(route("api.products.orders.index", product))
                    .then((response) => {
                        this.onHoldProductQuotes = response.data.on_hold;
                        this.soldProductOrders = response.data.sold;
                    });
            }
        },
    },
};
</script>
