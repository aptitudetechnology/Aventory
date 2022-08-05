<template>
    <customers-layout>
        <details-section>
            <template #header>{{ customer.name }}</template>
            <div class="sm:col-span-2">
                <dt class="text-sm text-gray-500">Customer name</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ customer.name }}
                </dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm text-gray-500">Customer Address</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ customer.address }}
                </dd>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ customer.city }} {{ customer.state }} {{ customer.zip }}
                </dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm text-gray-500">Notes</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ customer.notes }}
                </dd>
            </div>
        </details-section>
        <restore-customer-form
            :customer="customer"
            class="mt-6"
        ></restore-customer-form>
    </customers-layout>
</template>

<script>
import { PaperClipIcon } from "@heroicons/vue/solid";
import CustomersLayout from "./CustomersLayout.vue";
import DetailsSection from "@/Components/DetailsSection.vue";
import RestoreCustomerForm from "./RestoreCustomerForm.vue";
export default {
    components: {
        PaperClipIcon,
        CustomersLayout,
        DetailsSection,
        RestoreCustomerForm,
    },
    props: { customer: Object },
};
</script>
