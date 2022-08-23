<script setup>
import DetailsSection from "@/Components/DetailsSection.vue";
import { ExternalLinkIcon } from "@heroicons/vue/outline";
import ButtonLink from "@/Components/Links/ButtonLink.vue";

import { onMounted, reactive, computed } from "vue";

const activeQuotes = reactive({
    quotes: [],
    total: "",
    count: 0,
    loading: true,
});

const headingText = computed(() => {
    return `${activeQuotes.total} in active quotes`;
});

const numberQuotesText = computed(() => {
    return activeQuotes.count > 1 || activeQuotes.count == 0
        ? `${activeQuotes.count} quotes`
        : `${activeQuotes.count} quote`;
});

const totalText = computed(() => {
    return `There are ${activeQuotes.count} active quotes with a total of ${activeQuotes.total} that could be converted to an order.`;
});

onMounted(() => {
    axios
        .get(route("api.quotes.index"))
        .then((response) => {
            activeQuotes.quotes = response.data.quotes;
            activeQuotes.total = response.data.total_in_dollars;
            activeQuotes.count = response.data.count;
            activeQuotes.loading = false;
        })
        .catch((error) => {
            console.log(error);
        });
});
</script>

<template>
    <details-section>
        <template #title>{{ headingText }}</template>
        <div class="col-span-6">
            <p class="text-lg mb-2">{{ numberQuotesText }}</p>
            <p>{{ totalText }}</p>
        </div>

        <template #actions>
            <button-link :href="route('quotes.index')">View Quotes</button-link>
        </template>
    </details-section>
</template>
