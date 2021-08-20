<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="isIndex">
        <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
          <div class="px-4 md:pb-2">
            <back-link
              v-if="route().current('vendors.*')"
              :href="route('vendors.index')"
              >vendors</back-link
            >
            <back-link v-else :href="route('archived-vendors.index')"
              >Archived vendors</back-link
            >
          </div>
        </nav>
        <!-- Main Content -->
        <div class="py-2">
          <slot></slot>
        </div>
      </main-area>
      <!-- Start secondary column (hidden on smaller screens) -->
      <vendors-aside :vendors="vendors" />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackLink from "@/Components/BackLink";
import VendorsAside from "./VendorsAside";
import MainArea from "../../Components/MainArea.vue";

export default {
  components: {
    VendorsAside,
    AppLayout,
    BackLink,
    MainArea,
  },
  computed: {
    vendors() {
      return this.$page.props.vendors;
    },
    isIndex() {
      return (
        route().current("vendors.index") ||
        route().current("archived-vendors.index")
      );
    },
  },
};
</script>
