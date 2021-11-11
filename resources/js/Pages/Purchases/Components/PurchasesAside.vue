<template>
    <page-aside :showOnMobile="route().current('purchases.index')">
        <template v-slot:header>
            <jet-section-title>
                <template #title>Purchases</template>
                <template v-if="purchasesLength > 0" #description
                    >Search {{ purchasesLength }}
                    {{
                        purchasesLength > 1 ? "Purchases" : "Purchase"
                    }}</template
                >

                <template #aside
                    ><button-link :href="route('purchases.create')"
                        >New Purchase</button-link
                    ></template
                >
            </jet-section-title>
            <search-input
                v-if="purchasesLength > 0"
                v-model="search"
                @input="updatePurchases"
                placeholder="Search by purchase number, vendor, or date."
            />
        </template>

        <div class="bg-white">
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="purchase in filteredPurchases"
                    :key="purchase.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="
                            purchase.deleted_at
                                ? route('archived-purchases.show', purchase.id)
                                : route('purchases.show', purchase.id)
                        "
                        :current="
                            route().current('purchases.show', purchase.id) ||
                            route().current(
                                'archived-purchases.show',
                                purchase.id
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
                                    <b class="font-bold">Vendor: </b
                                    >{{ purchase.vendor.name }}
                                </p>
                                <p
                                    v-if="purchase.purchase_number"
                                    class="text-sm text-gray-900 truncate"
                                >
                                    <b class="font-bold">Purchase Number: </b
                                    >{{ purchase.order_number }}
                                </p>
                                <p class="text-sm text-gray-900 truncate">
                                    <b class="font-bold">Purchase Date: </b
                                    >{{
                                        new Date(purchase.date).toDateString()
                                    }}
                                </p>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state
            v-if="purchasesLength < 1 && route().current('purchases.index')"
            heading="No Purchases"
            subtitle="Get started by creating a new purchase."
            button-text="New Purchase"
            :href="route('purchases.create')"
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
    props: {
        purchases: Array,
    },
    computed: {
        purchasesLength: function () {
            return this.purchases.length;
        },
    },
    data() {
        return {
            search: "",
            filteredPurchases: this.purchases,
        };
    },
    methods: {
        updatePurchases() {
            this.filteredPurchases = this.purchases.filter((purchase) => {
                let lowerSearch = this.search.toLowerCase();
                if (
                    purchase.vendor_name.toLowerCase().includes(lowerSearch) ||
                    purchase.date?.includes(lowerSearch) ||
                    purchase.order_number?.toLowerCase().includes(lowerSearch)
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
