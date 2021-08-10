<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main
        :class="[
          route().current('customers.index') ||
          route().current('archived-customers.index')
            ? 'hidden lg:block flex-1 relative z-0 overflow-y-auto focus:outline-none md:order-last'
            : 'flex-1 relative z-0 overflow-y-auto focus:outline-none md:order-last',
        ]"
      >
        <div class="py-6 sm:px-6 lg:px-8">
          <nav
            v-if="!route().current('customers.index')"
            aria-label="Breadcrumb"
            class="xl:hidden"
          >
            <div class="px-4 md:pb-2">
              <back-link :href="route('customers.index')">Customers</back-link>
            </div>
          </nav>
          <!-- Main Content -->
          <div class="py-2">
            <slot></slot>
          </div>
        </div>
        <!-- End main area -->
      </main>
      <!-- Start secondary column (hidden on smaller screens) -->
      <customers-aside :customers="customers"/>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { PlusIcon } from "@heroicons/vue/solid";
import EmptyState from "@/Components/EmptyState";
import ButtonLink from "@/Components/ButtonLink";
import CreateCustomerForm from "./CreateCustomerForm";
import { XIcon } from "@heroicons/vue/outline";
import { FilterIcon, SearchIcon, ChevronLeftIcon } from "@heroicons/vue/solid";
import BackLink from "@/Components/BackLink";
import TabLink from "../../Components/TabLink.vue";
import CustomersAside from "@/Pages/Customers/CustomersAside";

export default {
  components: {
      CustomersAside,
    EmptyState,
    AppLayout,
    PlusIcon,
    ButtonLink,
    CreateCustomerForm,
    SearchIcon,
    FilterIcon,
    XIcon,
    ChevronLeftIcon,
    BackLink,
    TabLink,
  },
  computed: {
    customers() {
      return this.$page.props.customers;
    },
  },
};
</script>
