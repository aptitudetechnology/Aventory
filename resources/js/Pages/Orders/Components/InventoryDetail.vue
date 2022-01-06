<template>
    <div>
        <transition name="fade" mode="out-in">
            <ErrorMessage v-if="error" />
            <Loading v-else-if="loading" />
            <div v-else class="sm:text-right divide-y">
                <jet-label
                    data-tip="The total amount of these items in inventory. They may be ready, but their ready date states not."
                    class="py-2 mr-0 tooltip lg:tooltip-right"
                    :value="'Total In Nursery: ' + quantities.inNursery"
                />
                <jet-label
                    data-tip="Inventory that is ready to sell - inventory in orders that haven't been completed yet."
                    class="py-2 mr-0 tooltip lg:tooltip-right"
                    :value="'Ready to sell: ' + quantities.availableForSale"
                />
                <jet-label
                    class="py-2 mr-0"
                    :value="'On Hold: ' + quantities.onHold"
                />
                <jet-label
                    data-tip="The amount ready to sell - the amount of inventory in active quotes on hold."
                    class="
                        py-2
                        mr-0
                        font-bold
                        text-base
                        tooltip
                        lg:tooltip-right
                    "
                    :value="
                        'Available For Sale: ' + quantities.availableForSale
                    "
                />
            </div>
        </transition>
    </div>
</template>

<script>
import ErrorMessage from "@/Components/ErrorMessage";
import Loading from "@Components/Messages/Loading";
export default {
    components: { ErrorMessage, Loading },
    props: {
        product: Object | Boolean,
        size: Object | Boolean,
    },
    data() {
        return {
            loading: false,
            error: false,
            quantities: {
                inNursery: 0,
                availableForSale: 0,
                onHold: 0,
                ready: 0,
            },
        };
    },
    mounted() {
        this.getQuantities();
    },
    watch: {
        product() {
            this.getQuantities();
        },
        size() {
            this.getQuantities();
        },
        quantities: {
            handler() {
                this.$emit("update", this.quantities);
            },
            deep: true,
        },
    },

    methods: {
        getQuantities() {
            if (this.product && this.size) {
                this.error = false;
                this.loading = true;
                axios
                    .get(
                        route("api.inventory.quantities", [
                            this.product.id,
                            this.size.id,
                        ])
                    )
                    .then((response) => {
                        this.quantities.inNursery = response.data.total;
                        this.quantities.ready = response.data.ready;
                        this.quantities.onHold = response.data.onHold;
                        this.quantities.availableForSale =
                            response.data.available;
                    })
                    .catch((error) => {
                        this.error = true;
                        console.error(error.message);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            } else {
                this.resetQuantities();
            }
        },
        resetQuantities() {
            this.quantities.inNursery = 0;
            this.quantities.ready = 0;
            this.quantities.onHold = 0;
            this.quantities.availableForSale = 0;
        },
    },
};
</script>
