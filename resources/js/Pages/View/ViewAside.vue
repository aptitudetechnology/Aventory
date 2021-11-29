<template>
    <page-aside :showOnMobile="route().current('view.index')">
        <template v-slot:header>
            <jet-section-title>
                <template #title>Products</template>
                <template v-if="productsLength > 0" #description
                    >Search {{ productsLength }}
                    {{ productsLength > 1 ? "Products" : "Product" }}</template
                >
            </jet-section-title>
            <search-input v-model="search" placeholder="Search products" />
        </template>

        <div class="bg-white">
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="product in filteredProducts"
                    :key="product.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="route('view.show', product.id)"
                        :current="route().current('view.show', product.id)"
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

            <div class="p-6" v-if="search != '' && filteredProducts.length < 1">
                No items match that search.
                <span @click="search = ''" class="underline cursor-pointer"
                    >Clear search?</span
                >
            </div>
        </div>
    </page-aside>
</template>
<script>
import ButtonLink from "@Components/Links/ButtonLink";
import SearchInput from "@Components/Forms/SearchInput.vue";
import PageAside from "@Components/PageAside.vue";
import AsideLink from "@/Components/Links/AsideLink.vue";
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
export default {
    components: {
        PageAside,
        AsideLink,
        ButtonLink,
        SearchInput,
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
    watch: {
        search() {
            this.updateProducts();
        },
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
