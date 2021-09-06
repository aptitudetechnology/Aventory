<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="isIndex">
        <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
          <div class="px-4 md:pb-2">
            <back-link
              v-if="route().current('orders.*')"
              :href="route('orders.index')"
              >Orders</back-link
            >
          </div>
        </nav>
        <!-- Main Content -->
        <div class="py-2">
          <slot></slot>
        </div>
      </main-area>
      <!-- Start secondary column (hidden on smaller screens) -->
      <orders-aside :orders="orders" />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackLink from "@/Components/BackLink";
import OrdersAside from "./OrdersAside";
import MainArea from "@Components/MainArea.vue";

export default {
  components: {
    OrdersAside,
    AppLayout,
    BackLink,
    MainArea,
  },
  computed: {
    orders() {
      return this.$page.props.orders;
    },
    isIndex() {
      return (
        route().current("orders.index") ||
        route().current("archived-orders.index")
      );
    },
  },
};
</script>
