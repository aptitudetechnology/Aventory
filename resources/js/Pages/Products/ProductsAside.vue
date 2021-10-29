<template>
    <page-aside
        :showOnMobile="
            route().current('products.index') ||
            route().current('archived-products.index')
        "
    >
        <template v-slot:header>
            <jet-section-title>
                <template #title>Products</template>
                <template v-if="productsLength > 0" #description
                    >Search {{ productsLength }}
                    {{ productsLength > 1 ? "Products" : "Product" }}</template
                >

                <template #aside
                    ><button-link :href="route('products.create')"
                        >New Product</button-link
                    ></template
                >
            </jet-section-title>
            <search-input
                v-model="search"
                @input="updateProducts"
                placeholder="Search products"
            />
        </template>

        <div class="bg-white">
            <tab-container>
                <tab-link
                    :href="route('products.index')"
                    :current="route().current('products.*')"
                    >Active</tab-link
                >
                <tab-link
                    :href="route('archived-products.index')"
                    :current="route().current('archived-products.*')"
                    >Archived</tab-link
                >
            </tab-container>
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="product in filteredProducts"
                    :key="product.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="
                            product.deleted_at
                                ? route('archived-products.show', product.id)
                                : route('products.show', product.id)
                        "
                        :current="
                            route().current('products.show', product.id) ||
                            route().current(
                                'archived-products.show',
                                product.id
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
                                    {{ product.name }}
                                </p>
                                <p
                                    v-if="product.description"
                                    class="text-sm text-gray-500 truncate"
                                >
                                    {{ product.description }}
                                </p>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state
            v-if="productsLength < 1 && route().current('products.index')"
            heading="No Products"
            subtitle="Get started by creating a new product."
            button-text="New Product"
            :href="route('products.create')"
        />
    </page-aside>
</template>
<script>
import ButtonLink from "@Components/ButtonLink";
import TabContainer from "@Components/TabContainer.vue";
import TabLink from "@Components/TabLink";
import SearchInput from "@Components/SearchInput.vue";
import PageAside from "@Components/PageAside.vue";
import AsideLink from "@Components/AsideLink.vue";
import EmptyState from "@Components/EmptyState.vue";
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
export default {
    components: {
        PageAside,
        AsideLink,
        ButtonLink,
        TabContainer,
        TabLink,
        SearchInput,
        EmptyState,
        JetSectionTitle,
    },
    computed: {
        productsLength: function () {
            return this.products.length;
        },
    },
    data() {
        return {
            products: this.$page.props.products,
            search: "",
            filteredProducts: this.$page.props.products,
        };
    },
    methods: {
        updateProducts() {
            this.filteredProducts = this.products.filter((product) => {
                if (
                    product.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase())
                ) {
                    return true;
                } else {
                    return false;
                }
            });
        },
    },
};
</script>
