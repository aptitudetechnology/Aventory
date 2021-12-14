<template>
    <div>
        <tab-container class="px-0"
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
                <product-hold-item
                    :item="item"
                    v-for="item in onHoldInventoryQuoteItems"
                    :key="item.id"
                />
            </div>
            <div v-else>
                <product-hold-item
                    :item="item"
                    v-for="item in soldProductOrderItems"
                    :key="item.id"
                />
            </div>
        </div>
    </div>
</template>
<script>
import TabContainer from "@Components/TabContainer.vue";
import TabLink from "@Components/Links/TabLink.vue";
import ProductHoldItem from "./ProductHoldItem.vue";
export default {
    components: {
        TabContainer,
        TabLink,
        ProductHoldItem,
    },
    props: {
        orderId: {
            type: Number,
            required: true,
        },
        product: {
            type: [Object, Boolean],
            required: false,
        },
        size: {
            type: [Object, Boolean],
            required: false,
        },
    },
    mounted() {
        if (this.product) {
            this.getSoldAndHoldInventoryItemsForProduct(this.product);
        }
    },
    data() {
        return {
            onHoldInventoryQuoteItems: [],
            soldProductOrderItems: [],
            onHoldProductInventoryForSize: [],
            soldProductInventoryForSize: [],
            viewingOnHold: true,
        };
    },
    watch: {
        product(product) {
            if (product) {
                this.getSoldAndHoldInventoryItemsForProduct(product);
            }
        },
        size(size) {
            if (size) {
                this.getSoldAndHoldInventoryForSize(size);
            }
        },
    },
    methods: {
        getSoldAndHoldInventoryItemsForProduct(product) {
            const filterById = (item) => item.order_id !== this.orderId;
            axios
                .get(route("api.products.orders.index", product))
                .then((response) => {
                    this.onHoldInventoryQuoteItems =
                        response.data.onHold.filter(filterById);
                    this.soldProductOrderItems =
                        response.data.inventorySold.filter(filterById);
                })
                .then(() => {
                    this.getSoldAndHoldInventoryForSize(this.size);
                })
                .catch((error) => {
                    console.error(error.message);
                });
        },
        getSoldAndHoldInventoryForSize(size) {
            if (size) {
                this.soldProductInventoryForSize =
                    this.soldProductOrderItems.filter(
                        (orderItem) => orderItem.size_id === size.id
                    );
                this.onHoldProductInventoryForSize =
                    this.onHoldInventoryQuoteItems.filter(
                        (orderItem) => orderItem.size_id === size.id
                    );
            } else {
                this.onHoldProductInventoryForSize = [];
                this.soldProductInventoryForSize = [];
            }
        },
    },
};
</script>
