<template>
  <page-aside :showOnMobile="route().current('features.index')">
    <template v-slot:header>
      <jet-section-title>
        <template #title>Plant Features</template>
        <template #description>View your plant features.</template>

        <template #aside
          ><button-link :href="route('features.create')"
            >New Feature</button-link
          ></template
        >
      </jet-section-title>
    </template>

    <div class="bg-white">
      <ul class="divide-y divide-gray-200">
        <li v-for="feature in features" :key="feature.id" class="bg-white">
          <aside-link
            :href="route('features.show', feature.id)"
            :current="route().current('features.show', feature.id)"
          >
            <div class="flex-1 min-w-0">
              <div class="focus:outline-none">
                <!-- Extend touch target to entire panel -->
                <span class="absolute inset-0" aria-hidden="true" />
                <p class="text-sm font-medium text-gray-900">
                  {{ feature.name }}
                </p>
                <p
                  v-if="feature.description"
                  class="text-sm text-gray-500 truncate"
                >
                  {{ feature.description }}
                </p>
              </div>
            </div>
          </aside-link>
        </li>
      </ul>
    </div>
    <empty-state
      v-if="features.length < 1 && route().current('features.index')"
      heading="No Features"
      subtitle="Get started by creating a new plant feature."
      button-text="New Feature"
      :href="route('features.create')"
    />
  </page-aside>
</template>
<script>
import ButtonLink from "@Components/ButtonLink";
import PageAside from "@Components/PageAside.vue";
import AsideLink from "@Components/AsideLink.vue";
import EmptyState from "@Components/EmptyState.vue";
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
export default {
  components: {
    PageAside,
    AsideLink,
    ButtonLink,
    EmptyState,
    JetSectionTitle,
  },
  props: {
    features: Array,
  },
};
</script>
