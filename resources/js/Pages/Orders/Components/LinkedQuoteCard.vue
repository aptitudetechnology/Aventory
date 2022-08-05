<template>
    <details-section>
        <template #title>Linked Quote </template>

        <div>
            <LoadingState :loading="loading" />
            <SmallLineItem
                v-if="quote"
                as="a"
                target="_blank"
                :href="route(quote.route, quote.id)"
                class="flex items-center justify-between py-2"
            >
                <div class="flex items-center">
                    <span class="text-sm">
                        {{ quote.name }}
                    </span>
                    <span class="text-sm ml-2">
                        {{ formatDate(quote.created_at) }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm ml-2">
                        {{ formatMoney(quote.total) }}
                    </span>
                </div>
            </SmallLineItem>
            <EmptyState
                v-else
                heading="This order was not created from a quote."
                :showIcon="false"
                align="left"
                class="p-0"
            />
        </div>
    </details-section>
</template>

<script>
import DetailsSection from "@/Components/DetailsSection.vue";
import SmallLineItem from "@/Components/Lists/SmallLineItem.vue";
import EmptyState from "@/Components/EmptyState.vue";
import LoadingState from "@/Components/LoadingState.vue";
export default {
    components: {
        DetailsSection,
        SmallLineItem,
        EmptyState,
        LoadingState,
    },
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            loading: false,
            quote: null,
        };
    },
    mounted() {
        this.getQuote();
    },
    methods: {
        getQuote() {
            this.loading = true;
            axios
                .get(route("api.orders.quote.show", this.order.id))
                .then((response) => {
                    this.quote = response.data;
                })
                .catch((error) => {
                    console.error(error.message);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
