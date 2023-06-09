<template>
    <div>
        <tab-container class="px-0 py-0 uppercase tracking-wide"
            ><tab-link
                as="button"
                :current="viewingOnHold"
                class="px-2"
                @click="viewingOnHold = true"
                >On Hold<span class="badge badge-outline badge-sm ml-2">{{
                    quantityOnHold
                }}</span></tab-link
            ><tab-link
                as="button"
                class="px-2"
                :current="!viewingOnHold"
                @click="viewingOnHold = false"
                >Sold<span class="badge badge-outline badge-sm ml-2">{{
                    quantitySold
                }}</span></tab-link
            ></tab-container
        >
        <div>
            <ErrorMessage v-if="error" />
            <LoadingState loading="loading" v-else-if="loading" />
            <div class="py-4" v-else-if="viewingOnHold">
                <product-hold-item
                    :item="item"
                    v-for="item in onHoldProductInventoryForSize"
                    :key="item.id"
                />
                <div v-if="!onHoldProductInventoryForSize.length">
                    <p class="text-gray-600 px-2">No items on hold.</p>
                </div>
            </div>
            <div class="py-4" v-else>
                <product-hold-item
                    :item="item"
                    :orderId="orderId"
                    v-for="item in soldProductInventoryForSize"
                    :key="item.id"
                />
                <div v-if="!soldProductInventoryForSize.length">
                    <p class="text-gray-600 px-2">
                        No items in uncompleted orders.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TabContainer from "@/Components/TabContainer.vue";
import TabLink from "@/Components/Links/TabLink.vue";
import ErrorMessage from "@/Components/ErrorMessage.vue";
import ProductHoldItem from "./ProductHoldItem.vue";
import LoadingState from "@/Components/LoadingState.vue";

export default {
    components: {
        TabContainer,
        TabLink,
        ErrorMessage,
        ProductHoldItem,
        LoadingState,
    },
    props: {
        orderId: {
            type: Number,
            required: false,
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
            loading: false,
            error: false,
            onHoldInventoryQuoteItems: [],
            soldProductOrderItems: [],
            viewingOnHold: true,
        };
    },
    computed: {
        soldProductInventoryForSize() {
            return this.soldProductOrderItems.filter(
                (item) => item.size_id == this.size?.id
            );
        },
        onHoldProductInventoryForSize() {
            return this.onHoldInventoryQuoteItems.filter(
                (item) => item.size_id == this.size?.id
            );
        },
        quantitySold() {
            return this.soldProductInventoryForSize.reduce(
                (total, item) => total + item.quantity,
                0
            );
        },
        quantityOnHold() {
            return this.onHoldProductInventoryForSize.reduce(
                (total, item) => total + item.quantity,
                0
            );
        },
    },
    watch: {
        product(newProduct) {
            this.getSoldAndHoldInventoryItemsForProduct(newProduct);
        },
    },
    methods: {
        getSoldAndHoldInventoryItemsForProduct(product) {
            if (product) {
                this.error = false;
                this.loading = true;
                axios
                    .get(route("api.products.orders.index", product))
                    .then((response) => {
                        this.onHoldInventoryQuoteItems = response.data.onHold;
                        this.soldProductOrderItems =
                            response.data.inventorySold;
                        this.updateViewingOnHold();
                    })
                    .catch((error) => {
                        this.error = true;
                        console.error(error.message);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            } else {
                this.resetSoldAndHoldInventoryItems();
            }
        },
        resetSoldAndHoldInventoryItems() {
            this.onHoldInventoryQuoteItems = [];
            this.soldProductOrderItems = [];
        },
        updateViewingOnHold() {
            this.viewingOnHold = this.quantityOnHold > this.quantitySold;
        },
    },
};
</script>
