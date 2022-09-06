<script setup>
import { computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import BackLink from "@/Components/Links/BackLink.vue";
import CustomersAside from "@/Pages/Customers/CustomersAside.vue";
import MainArea from "@/Components/MainArea.vue";
import ButtonLinkVue from "@/Components/Links/ButtonLink.vue";
const isIndex = computed(
    () =>
        route().current("customers.index") ||
        route().current("customers.archived-index")
);
</script>

<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="isIndex">
                <nav aria-label="Breadcrumb">
                    <div class="px-4 md:pb-2 flex justify-between">
                        <div class="xl:hidden">
                            <back-link
                                v-if="route().current('customers.*')"
                                :href="route('customers.index')"
                                >Customers</back-link
                            >
                            <back-link
                                v-else
                                :href="route('archived-customers.index')"
                                >Archived Customers</back-link
                            >
                        </div>

                        <div class="ml-auto grid grid-cols-2 gap-4">
                            <ButtonLinkVue
                                class="btn-secondary"
                                :href="route('customer-price-levels.index')"
                            >
                                Customer Price Levels
                            </ButtonLinkVue>
                            <ButtonLinkVue :href="route('customers.create')">
                                New Customer
                            </ButtonLinkVue>
                        </div>
                    </div>
                </nav>
                <!-- Main Content -->
                <div class="py-2">
                    <slot></slot>
                </div>
            </main-area>
            <!-- Start secondary column (hidden on smaller screens) -->
            <customers-aside />
        </div>
    </app-layout>
</template>
