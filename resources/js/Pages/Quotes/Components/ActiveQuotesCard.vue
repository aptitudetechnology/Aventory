<template>
    <details-section>
        <template #title>Quotes</template>
        <template #aside
            ><ExternalLinkIcon class="w-6 h-6 stroke-current"
        /></template>
        <div class="col-span-6">
            <p class="text-lg mb-2">{{ numActiveQuotes }} Active quotes</p>
            <p>{{ totalActiveQuotes }} in active quotes</p>
        </div>
    </details-section>
</template>
<script>
import DetailsSection from "@Components/DetailsSection.vue";
import { ExternalLinkIcon } from "@heroicons/vue/outline";
import money from "@/utils/money";
export default {
    extends: money,
    components: {
        DetailsSection,
        ExternalLinkIcon,
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
