<template>
    <page-aside :showOnMobile="route().current('blocks.index')">
        <template v-slot:header>
            <jet-section-title>
                <template #title>Nursery Blocks</template>

                <template #aside>
                    <button-link :href="route('blocks.create')">New Block</button-link>
                </template>
            </jet-section-title>
        </template>

        <div class="bg-white">
            <ul class="divide-y divide-gray-200">
                <li v-for="block in blocks" :key="block.id" class="bg-white">
                    <aside-link :href="route('blocks.show', block.id)" :current="
                        route().current('blocks.show', block.id) ||
                        route().current('blocks.edit', block.id)
                    ">
                        <div class="flex-1 min-w-0">
                            <div class="focus:outline-none">
                                <!-- Extend touch target to entire panel -->
                                <span class="absolute inset-0" aria-hidden="true" />
                                <div class="text-sm text-gray-900">
                                    <p>{{ block.BlockDisplayName }}</p>

                                    <p v-if="block.nursery_location" class="text-sm text-gray-500 truncate"
                                        :set="{ city, zip, state } = block.nursery_location">
                                        <template v-if="city">
                                            <strong>City : {{ city }} </strong>&nbsp;
                                        </template>
                                        <template v-if="zip">
                                            <strong>Zip : {{ zip }} </strong>&nbsp;
                                        </template>
                                        <template v-if="state">
                                            <strong>State : {{ state }} </strong>&nbsp;
                                        </template>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state v-if="blocksLength < 1 && route().current('blocks.index')" heading="No Blocks"
            subtitle="Get started by creating a new block." button-text="New Block" :href="route('blocks.create')" />
    </page-aside>
</template>
<script>
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import PageAside from "@/Components/PageAside.vue";
import AsideLink from "@/Components/Links/AsideLink.vue";
import EmptyState from "@/Components/EmptyState.vue";
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
        blocks: Array,
    },
    computed: {
        blocksLength: function () {
            return this.blocks.length;
        },
    },
};
</script>