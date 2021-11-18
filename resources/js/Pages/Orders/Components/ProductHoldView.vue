<template>
    <div>
        <tab-container
            ><tab-link as="button">On Hold</tab-link
            ><tab-link as="button">Sold</tab-link></tab-container
        >
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
        };
    },
    watch: {
        product(product) {
            if (product) {
                axios
                    .get(route("api.products.orders.index", product))
                    .then((response) => {
                        this.onHoldProductQuotes = response.data.onHold;
                        this.soldProductOrders = response.data.sold;
                    });
            }
        },
    },
};
</script>
