<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customers
            </h2>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="customers" class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ul class="relative z-0 divide-y divide-gray-200">
                        <li v-for="customer in customers" :key="customer.id" class="bg-white">
                            <div class="relative px-6 py-5 flex items-center space-x-3 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                <div class="flex-1 min-w-0">
                                    <a href="#" class="focus:outline-none">
                                        <!-- Extend touch target to entire panel -->
                                        <span class="absolute inset-0" aria-hidden="true" />
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ customer.name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            {{ customer.city }}, {{ customer.state}}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <empty-state v-else heading="No Customers" subtitle="Get started by creating a new customer." button-text="New Customer" :href="route('customers.create')" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { PlusIcon } from '@heroicons/vue/solid'
import EmptyState from "@/Components/EmptyState";
export default {
    components: {
        EmptyState,
        AppLayout,
        PlusIcon
    },
    props: ['customers']
}
</script>
