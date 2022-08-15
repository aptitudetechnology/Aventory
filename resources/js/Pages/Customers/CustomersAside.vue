<template>
    <page-aside
        :showOnMobile="
            route().current('customers.index') ||
            route().current('archived-customers.index')
        "
    >
        <template v-slot:header>
            <jet-section-title>
                <template #title>Customer Directory</template>
                <template v-if="customersLength > 0" #description
                    >Search {{ customersLength }}
                    {{
                        customersLength > 1 ? "Customers" : "Customer"
                    }}</template
                >

                <template #aside
                    ><button-link :href="route('customers.create')"
                        >New Customer</button-link
                    ></template
                >
            </jet-section-title>
            <search-input
                v-model="search"
                @input="updateCustomers"
                placeholder="Search by customer name or state."
            />
        </template>

        <div class="bg-white">
            <tab-container>
                <tab-link
                    :href="route('customers.index')"
                    :current="route().current('customers.*')"
                    >Active</tab-link
                >
                <tab-link
                    :href="route('archived-customers.index')"
                    :current="route().current('archived-customers.*')"
                    >Archived</tab-link
                >
            </tab-container>
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="customer in filteredCustomers"
                    :key="customer.id"
                    class="bg-white"
                >
                    <aside-link
                        :href="
                            customer.deleted_at
                                ? route('archived-customers.show', customer.id)
                                : route('customers.show', customer.id)
                        "
                        :current="
                            route().current('customers.show', customer.id) ||
                            route().current(
                                'archived-customers.show',
                                customer.id
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
                                <div class="flex justify-between items-center">
                                    <p class="text-sm text-gray-900">
                                        {{ customer.name }}
                                    </p>
                                    <span
                                        class="inline-flex justify-center items-center w-3 h-3 text-xs font-bold text-white rounded-full border-2 border-white dark:border-gray-900"
                                        :class="statusClass(customer)"
                                        :title="customer.codat_push_status"
                                    ></span>
                                </div>
                                <p
                                    v-if="customer.state"
                                    class="text-sm text-gray-500 truncate"
                                >
                                    {{ customer.state }}
                                </p>
                            </div>
                        </div>
                    </aside-link>
                </li>
            </ul>
        </div>
        <empty-state
            v-if="customersLength < 1 && route().current('customers.index')"
            heading="No Customers"
            subtitle="Get started by creating a new customer."
            button-text="New Customer"
            :href="route('customers.create')"
        />
    </page-aside>
</template>
<script>
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import TabContainer from "@/Components/TabContainer.vue";
import TabLink from "@/Components/Links/TabLink.vue";
import SearchInput from "@/Components/Forms/SearchInput.vue";
import PageAside from "@/Components/PageAside.vue";
import AsideLink from "@/Components/Links/AsideLink.vue";
import EmptyState from "@/Components/EmptyState.vue";
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
        customers: Array,
    },
    computed: {
        customersLength: function () {
            return this.customers.length;
        },
    },
    data() {
        return {
            search: "",
            filteredCustomers: this.customers,
        };
    },
    methods: {
        updateCustomers() {
            this.filteredCustomers = this.customers.filter((customer) => {
                if (
                    customer.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    customer.state
                        ?.toLowerCase()
                        .includes(this.search.toLowerCase())
                ) {
                    return true;
                } else {
                    return false;
                }
            });
        },
        statusClass(customer) {
            if (customer.codat_push_status === "Pending") {
                return "bg-warning";
            } else if (customer.codat_push_status === "Success") {
                return "bg-success";
            } else if (customer.codat_push_status === "Failed") {
                return "bg-error";
            } else {
                return "bg-primary";
            }
        },
    },
};
</script>
