<template>
  <page-aside
    :showOnMobile="
      route().current('customers.index') ||
      route().current('archived-customers.index')
    "
  >
    <template v-slot:header>
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-lg font-medium text-gray-900">Customer Directory</h2>
          <p v-if="customersLength > 0" class="mt-1 text-sm text-gray-600">
            Search {{ customersLength }}
            {{ customersLength > 1 ? "Customers" : "Customer" }}
          </p>
        </div>
        <button-link :href="route('customers.create')"
          >New Customer</button-link
        >
      </div>
      <search-input
        v-model="search"
        @input="updateCustomers"
        placeholder="Search by customer name or state."
      />
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
    </template>

    <div v-if="customersLength > 0" class="bg-white">
      <ul class="divide-y divide-gray-200">
        <li
          v-for="customer in filteredCustomers"
          :key="customer.id"
          class="bg-white"
        >
          <div
            class="
              relative
              px-6
              py-5
              flex
              items-center
              space-x-3
              hover:bg-gray-50
              focus-within:ring-2
              focus-within:ring-inset
              focus-within:ring-indigo-500
            "
          >
            <div class="flex-1 min-w-0">
              <inertia-link
                :href="
                  customer.deleted_at
                    ? route('archived-customers.show', customer.id)
                    : route('customers.show', customer.id)
                "
                class="focus:outline-none"
              >
                <!-- Extend touch target to entire panel -->
                <span class="absolute inset-0" aria-hidden="true" />
                <p class="text-sm font-medium text-gray-900">
                  {{ customer.name }}
                </p>
                <p v-if="customer.state" class="text-sm text-gray-500 truncate">
                  {{ customer.state }}
                </p>
              </inertia-link>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </page-aside>
</template>
<script>
import ButtonLink from "../../Components/ButtonLink";
import TabContainer from "../../Components/TabContainer.vue";
import TabLink from "../../Components/TabLink";
import SearchInput from "../../Components/SearchInput.vue";
import PageAside from "../../Components/PageAside.vue";
export default {
  components: { PageAside, ButtonLink, TabContainer, TabLink, SearchInput },
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
          customer.name.toLowerCase().includes(this.search.toLowerCase()) ||
          customer.state?.toLowerCase().includes(this.search.toLowerCase())
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
