<template>
  <page-aside :showOnMobile="route().current('locations.index')">
    <template v-slot:header>
      <jet-section-title>
        <template #title>Nursery Locations</template>

        <template #aside
          ><button-link :href="route('locations.create')"
            >New Location</button-link
          ></template
        >
      </jet-section-title>
    </template>

    <div class="bg-white">
      <ul class="divide-y divide-gray-200">
        <li v-for="location in locations" :key="location.id" class="bg-white">
          <aside-link
            :href="route('locations.show', location.id)"
            :current="route().current('locations.show', location.id)"
          >
            <div class="flex-1 min-w-0">
              <div class="focus:outline-none">
                <!-- Extend touch target to entire panel -->
                <span class="absolute inset-0" aria-hidden="true" />
                <p class="text-sm font-medium text-gray-900">
                  {{ location.name }}
                </p>
                <p v-if="location.city" class="text-sm text-gray-500 truncate">
                  {{ location.city
                  }}<span v-if="location.state">, {{ location.state }}</span>
                </p>
              </div>
            </div>
          </aside-link>
        </li>
      </ul>
    </div>
    <empty-state
      v-if="locationsLength < 1 && route().current('locations.index')"
      heading="No Locations"
      subtitle="Get started by creating a new location."
      button-text="New Location"
      :href="route('locations.create')"
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
    locations: Array,
  },
  computed: {
    locationsLength: function () {
      return this.locations.length;
    },
  },
};
</script>
