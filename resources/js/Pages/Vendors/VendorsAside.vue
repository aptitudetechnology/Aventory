<template>
    <page-aside
        :showOnMobile="
            route().current('vendors.index') ||
            route().current('archived-vendors.index')
        "
    >
        <template v-slot:header>
            <jet-section-title>
                <template #title>Vendor Directory</template>
                <template v-if="vendorsLength > 0" #description
                    >Search {{ vendorsLength }}
                    {{ vendorsLength > 1 ? "Vendors" : "Vendor" }}</template
                >

                <template #aside
                    ><button-link :href="route('vendors.create')"
                        >New Vendor</button-link
                    ></template
                >
            </jet-section-title>
            <search-input
                v-model="search"
                @input="updateVendors"
                placeholder="Search by vendor name or state."
            />
        </template>

        <div class="bg-white">
            <tab-container>
                <tab-link
                    :href="route('vendors.index')"
                    :current="route().current('vendors.*')"
                    >Active</tab-link
                >
                <tab-link
                    :href="route('archived-vendors.index')"
                    :current="route().current('archived-vendors.*')"
                    >Archived</tab-link
                >
            </tab-container>
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="vendor in filteredVendors"
                    :key="vendor.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="
                            vendor.deleted_at
                                ? route('archived-vendors.show', vendor.id)
                                : route('vendors.show', vendor.id)
                        "
                        :current="
                            route().current('vendors.show', vendor.id) ||
                            route().current('archived-vendors.show', vendor.id)
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
                                    {{ vendor.name }}
                                </p>
                                <p
                                    v-if="vendor.state"
                                    class="text-sm text-gray-500 truncate"
                                >
                                    {{ vendor.state }}
                                </p>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state
            v-if="vendorsLength < 1 && route().current('vendors.index')"
            heading="No Vendors"
            subtitle="Get started by creating a new vendor."
            button-text="New Vendor"
            :href="route('vendors.create')"
        />
    </page-aside>
</template>
<script>
import ButtonLink from "@Components/Links/ButtonLink";
import TabContainer from "@Components/TabContainer.vue";
import TabLink from "@Components/Links/TabLink";
import SearchInput from "@Components/Forms/SearchInput.vue";
import PageAside from "@Components/PageAside.vue";
import AsideLink from "@/Components/Links/AsideLink.vue";
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
        vendors: Array,
    },
    computed: {
        vendorsLength: function () {
            return this.vendors.length;
        },
    },
    data() {
        return {
            search: "",
            filteredVendors: this.vendors,
        };
    },
    methods: {
        updateVendors() {
            this.filteredVendors = this.vendors.filter((vendor) => {
                if (
                    vendor.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    vendor.state
                        ?.toLowerCase()
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
