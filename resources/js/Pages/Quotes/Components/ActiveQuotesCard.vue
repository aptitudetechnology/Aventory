<template>
    <details-section>
        <template #title>Quotes</template>
        <div class="col-span-6">
            <p class="text-lg mb-2">{{ numActiveQuotes }} Active quotes</p>
            <p>{{ totalActiveQuotes }} in active quotes</p>
        </div>

        <template #actions>
            <button-link :href="route('quotes.index')">View Quotes</button-link>
        </template>
    </details-section>
</template>
<script>
import DetailsSection from "@Components/DetailsSection.vue";
import { ExternalLinkIcon } from "@heroicons/vue/outline";
import ButtonLink from "@Components/Links/ButtonLink.vue";
export default {
    components: {
        DetailsSection,
        ExternalLinkIcon,
        ButtonLink,
    },
    data() {
        return {
            activeQuotes: [],
        };
    },
    mounted() {
        this.getActiveQuotes();
    },
    computed: {
        numActiveQuotes() {
            return this.activeQuotes.length;
        },
        totalActiveQuotes() {
            return this.formatMoney(
                this.activeQuotes.reduce(
                    (total, quote) => total + quote.grand_total,
                    0
                )
            );
        },
    },
    methods: {
        getActiveQuotes() {
            axios.get(route("api.quotes.active")).then((response) => {
                this.activeQuotes = response.data;
            });
        },
    },
};
</script>
