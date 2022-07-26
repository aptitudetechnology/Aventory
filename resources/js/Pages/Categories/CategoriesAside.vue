<template>
    <page-aside :showOnMobile="route().current('categories.index')">
        <template v-slot:header>
            <jet-section-title>
                <template #title>Product Categories</template>
                <template #description>View your product categories.</template>

                <template #aside
                    ><button-link :href="route('categories.create')"
                        >New Category</button-link
                    ></template
                >
            </jet-section-title>
        </template>

        <div class="bg-white">
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="category in categories"
                    :key="category.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="route('categories.show', category.id)"
                        :current="
                            route().current('categories.show', category.id)
                        "
                    >
                        <div class="flex-1 min-w-0">
                            <div class="focus:outline-none">
                                <!-- Extend touch target to entire panel -->
                                <span
                                    class="absolute inset-0"
                                    aria-hidden="true"
                                />
                                <p class="text-sm text-gray-900">
                                    {{ category.name }}
                                </p>
                                <p
                                    v-if="category.description"
                                    class="text-sm text-gray-500 truncate"
                                >
                                    {{ category.description }}
                                </p>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state
            v-if="categories.length < 1 && route().current('categories.index')"
            heading="No Categories"
            subtitle="Get started by creating a new product category."
            button-text="New Category"
            :href="route('categories.create')"
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
        categories: Array,
    },
};
</script>
