<template>
  <page-aside :showOnMobile="route().current('customer-price-levels.index')">
    <template v-slot:header>
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-lg font-medium text-gray-900">Price Levels</h2>
          <p class="mt-1 text-sm text-gray-600">View your price levels.</p>
        </div>
        <button-link :href="route('customer-price-levels.create')"
          >New Level</button-link
        >
      </div>
    </template>

    <div class="bg-white">
      <ul class="divide-y divide-gray-200">
        <li v-for="level in priceLevels" :key="level.id" class="bg-white">
          <aside-link
            :href="route('customer-price-levels.show', level.id)"
            :current="route().current('customer-price-levels.show', level.id)"
          >
            <div class="flex-1 min-w-0">
              <div class="focus:outline-none">
                <!-- Extend touch target to entire panel -->
                <span class="absolute inset-0" aria-hidden="true" />
                <p class="text-sm font-medium text-gray-900">
                  {{ level.name }}
                </p>
                <p
                  v-if="level.description"
                  class="text-sm text-gray-500 truncate"
                >
                  {{ level.description }}
                </p>
              </div>
            </div>
          </aside-link>
        </li>
      </ul>
    </div>
    <empty-state
      v-if="
        priceLevels.length < 1 && route().current('customer-price-levels.index')
      "
      heading="No Price Levels"
      subtitle="Get started by creating a new price level."
      button-text="New Price Level"
      :href="route('customer-price-levels.create')"
    />
  </page-aside>
</template>
<script>
import ButtonLink from "../../Components/ButtonLink";
import PageAside from "../../Components/PageAside.vue";
import AsideLink from "../../Components/AsideLink.vue";
import EmptyState from "../../Components/EmptyState.vue";
export default {
  components: {
    PageAside,
    AsideLink,
    ButtonLink,
    EmptyState,
  },
  props: {
    priceLevels: Array,
  },
};
</script>
