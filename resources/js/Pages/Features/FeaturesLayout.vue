<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="isIndex">
        <nav v-if="!isIndex" aria-label="Breadcrumb" class="xl:hidden">
          <div class="px-4 md:pb-2">
            <back-link :href="route('features.index')">Features</back-link>
          </div>
        </nav>
        <!-- Main Content -->
        <div class="py-2">
          <slot></slot>
        </div>
      </main-area>
      <!-- Start secondary column (hidden on smaller screens) -->
      <features-aside :features="features" />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackLink from "@/Components/BackLink";
import FeaturesAside from "./FeaturesAside.vue";
import MainArea from "@Components/MainArea.vue";

export default {
  components: {
    FeaturesAside,
    AppLayout,
    BackLink,
    MainArea,
  },
  computed: {
    features() {
      return this.$page.props.features;
    },
    isIndex() {
      return route().current("features.index");
    },
  },
};
</script>
