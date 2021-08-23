<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <vendors-layout>
    <details-section>
      <template #header>{{ vendor.name }}</template>
      <div class="sm:col-span-2">
        <dt class="text-sm font-medium text-gray-500">Vendor name</dt>
        <dd class="mt-1 text-sm text-gray-900">
          {{ vendor.name }}
        </dd>
      </div>
      <div class="sm:col-span-1">
        <dt class="text-sm font-medium text-gray-500">Vendor Address</dt>
        <dd class="mt-1 text-sm text-gray-900">{{ vendor.address }}</dd>
        <dd class="mt-1 text-sm text-gray-900">
          {{ vendor.city }} {{ vendor.state }} {{ vendor.zip }}
        </dd>
      </div>
      <div class="sm:col-span-2">
        <dt class="text-sm font-medium text-gray-500">Notes</dt>
        <dd class="mt-1 text-sm text-gray-900">
          {{ vendor.notes }}
        </dd>
      </div>
    </details-section>
    <restore-vendor-form :vendor="vendor" class="mt-6"></restore-vendor-form>
  </vendors-layout>
</template>

<script>
import { PaperClipIcon } from "@heroicons/vue/solid";
import VendorsLayout from "./VendorsLayout.vue";
import DetailsSection from "@/Components/DetailsSection";
import RestoreVendorForm from "./RestoreVendorForm.vue";
export default {
  components: {
    PaperClipIcon,
    VendorsLayout,
    DetailsSection,
    RestoreVendorForm,
  },
  props: { vendor: Object },
};
</script>
