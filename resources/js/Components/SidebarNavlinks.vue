<template>
    <nav class="flex-1 px-2 bg-white space-y-1">
        <nav-link
            :href="route('dashboard')"
            :current="route().current('dashboard')"
            >Dashboard</nav-link
        >
        <nav-link
            :href="route('view.index')"
            :current="route().current('view.*')"
            >View Inventory</nav-link
        >
        <sidebar-dropdown
            dropdown_text="Customers"
            :current="
                route().current('customers.*') ||
                route().current('archived-customers.*') ||
                route().current('customer-price-levels.*')
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
                :href="route('customer-price-levels.index')"
                :current="route().current('customer-price-levels.*')"
                >Customer Price Levels</nav-link
            >
        </sidebar-dropdown>

        <sidebar-dropdown
            dropdown_text="Products & Pricing"
            :current="
                route().current('products.*') ||
                route().current('plants.*') ||
                route().current('features.*') ||
                route().current('categories.*') ||
                route().current('sizes.*')
            "
        >
            <nav-link
                :href="route('products.index')"
                :current="route().current('products.*')"
                >Products</nav-link
            >
            <nav-link
                :href="route('sizes.index')"
                :current="route().current('sizes.*')"
                >Product Sizes</nav-link
            >
            <nav-link
                :href="route('categories.index')"
                :current="route().current('categories.*')"
                >Product Categories</nav-link
            >
            <nav-link
                :href="route('features.index')"
                :current="route().current('features.*')"
                >Plant Features</nav-link
            >
        </sidebar-dropdown>

        <sidebar-dropdown
            dropdown_text="Inventory In"
            :current="
                route().current('vendors.*') ||
                route().current('archived-vendors.*') ||
                route().current('orders.*')
            "
        >
            <nav-link
                :href="route('orders.index')"
                :current="route().current('orders.*')"
                >Orders</nav-link
            >
            <nav-link
                :href="route('vendors.index')"
                :current="
                    route().current('vendors.*') ||
                    route().current('archived-vendors.*')
                "
                >Vendors</nav-link
            >
        </sidebar-dropdown>

        <sidebar-dropdown
            dropdown_text="Locations"
            :current="
                route().current('locations.*') || route().current('blocks.*')
            "
        >
            <nav-link
                :href="route('locations.index')"
                :current="route().current('locations.*')"
                >Nursery Locations</nav-link
            >
            <nav-link
                :href="route('blocks.index')"
                :current="route().current('blocks.*')"
                >Blocks</nav-link
            >
        </sidebar-dropdown>
        <nav-link
            :href="route('inventory.index')"
            :current="route().current('inventory.*')"
            >Inventory</nav-link
        >
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
