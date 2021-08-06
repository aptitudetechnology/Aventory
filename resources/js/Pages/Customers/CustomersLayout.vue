<template>
  <new-app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main
        class="
          flex-1
          relative
          z-0
          overflow-y-auto
          focus:outline-none
          md:order-last
        "
      >
        <!-- Start main area-->
        <div class="absolute inset-0 py-6 px-4 sm:px-6 lg:px-8">
          <slot></slot>
        </div>
        <!-- End main area -->
      </main>
      <!-- Start secondary column (hidden on smaller screens) -->
      <aside
        class="
          hidden
          xl:order-first
          xl:flex xl:flex-col
          flex-shrink-0
          w-96
          border-r border-gray-200
        "
      >
        <div class="px-6 pt-6 pb-4">
          <h2 class="text-lg font-medium text-gray-900">Customer Directory</h2>
          <p class="mt-1 text-sm text-gray-600">
            Search {{ customers.length }} Customers
          </p>
          <form class="mt-6 flex space-x-4" action="#">
            <div class="flex-1 min-w-0">
              <label for="search" class="sr-only">Search</label>
              <div class="relative rounded-md shadow-sm">
                <div
                  class="
                    absolute
                    inset-y-0
                    left-0
                    pl-3
                    flex
                    items-center
                    pointer-events-none
                  "
                >
                  <SearchIcon
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true"
                  />
                </div>
                <input
                  type="search"
                  name="search"
                  id="search"
                  class="
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    block
                    w-full
                    pl-10
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                  placeholder="Search"
                />
              </div>
            </div>
          </form>
        </div>

        <div class="flex-1 min-h-0 overflow-y-auto">
          <div
            v-if="customers.length > 0"
            class="bg-white shadow-xl sm:rounded-lg"
          >
            <ul class="divide-y divide-gray-200">
              <li
                v-for="customer in customers"
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
                      :href="route('customers.show', customer.id)"
                      class="focus:outline-none"
                    >
                      <!-- Extend touch target to entire panel -->
                      <span class="absolute inset-0" aria-hidden="true" />
                      <p class="text-sm font-medium text-gray-900">
                        {{ customer.name }}
                      </p>
                      <p
                        v-if="customer.state"
                        class="text-sm text-gray-500 truncate"
                      >
                        {{ customer.state }}
                      </p>
                    </inertia-link>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- End secondary column -->
      </aside>
      <empty-state
        v-if="customers.length < 1"
        heading="No Customers"
        subtitle="Get started by creating a new customer."
        button-text="New Customer"
        :href="route('customers.create')"
      />
    </div>
  </new-app-layout>
</template>

<script>
import NewAppLayout from "@/Layouts/NewAppLayout";
import { PlusIcon } from "@heroicons/vue/solid";
import EmptyState from "@/Components/EmptyState";
import ButtonLink from "@/Components/ButtonLink";
import CreateCustomerForm from "./CreateCustomerForm";
import { XIcon } from "@heroicons/vue/outline";
import { FilterIcon, SearchIcon } from "@heroicons/vue/solid";
export default {
  components: {
    EmptyState,
    NewAppLayout,
    PlusIcon,
    ButtonLink,
    CreateCustomerForm,
    SearchIcon,
    FilterIcon,
    XIcon,
  },
  computed: {
    customers() {
      return this.$page.props.customers;
    },
  },
};
</script>
