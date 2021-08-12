<template>
  <nav class="flex-1 px-2 bg-white space-y-1">
    <nav-link :href="route('dashboard')" :current="route().current('dashboard')"
      >Dashboard</nav-link
    >
    <sidebar-dropdown
      dropdown_text="Customers"
      :current="
        route().current('customers.*') ||
        route().current('archived-customers.*') ||
        route().current('price-levels.*')
      "
    >
      <nav-link
        :href="route('customers.index')"
        :current="
          route().current('customers.*') ||
          route().current('archived-customers.*')
        "
        >Customer Directory</nav-link
      >
      <nav-link
        :href="route('price-levels.index')"
        :current="route().current('price-levels.*')"
        >Customer Price Levels</nav-link
      >
    </sidebar-dropdown>
  </nav>
</template>
<script>
import NavLink from "./NavLink.vue";
import SidebarDropdown from "./SidebarDropdown.vue";

export default {
  components: {
    NavLink,
    SidebarDropdown,
  },
};
</script>
