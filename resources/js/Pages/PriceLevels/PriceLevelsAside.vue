<template>
    <page-aside :showOnMobile="route().current('customer-price-levels.index')">
        <template v-slot:header>
            <jet-section-title>
                <template #title>Price Levels</template>
                <template #description>View your price levels.</template>

                <template #aside
                    ><button-link :href="route('customer-price-levels.create')"
                        >New Level</button-link
                    ></template
                >
            </jet-section-title>
        </template>

        <div class="bg-white">
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="level in priceLevels"
                    :key="level.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="route('customer-price-levels.show', level.id)"
                        :current="
                            route().current(
                                'customer-price-levels.show',
                                level.id
                            )
                        "
                    >
                        <div class="flex-1 min-w-0">
                            <div class="focus:outline-none">
                                <!-- Extend touch target to entire panel -->
                                <span
                                    class="absolute inset-0"
                                    aria-hidden="true"
                                />
                                <p class="text-sm font-medium text-gray-900">
                                    {{ level.name }}
                                </p>
                                <p
                                    v-if="level.description"
                                    class="text-sm text-gray-500 truncate"
                                >
                                    {{ level.description }}
                                </p>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state
            v-if="
                priceLevels.length < 1 &&
                route().current('customer-price-levels.index')
            "
            heading="No Price Levels"
            subtitle="Get started by creating a new price level."
            button-text="New Price Level"
            :href="route('customer-price-levels.create')"
        />
    </page-aside>
</template>
<script>
import ButtonLink from "@Components/Links/ButtonLink";
import PageAside from "@Components/PageAside.vue";
import AsideLink from "@/Components/Links/AsideLink.vue";
import EmptyState from "@Components/EmptyState.vue";
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
export default {
    components: {
        PageAside,
        AsideLink,
        ButtonLink,
        EmptyState,
        JetSectionTitle,
    },
    props: {
        priceLevels: Array,
    },
};
</script>
