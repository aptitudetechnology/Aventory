<template>
    <vendors-layout>
        <div>
            <div class="lg:grid lg:grid-cols-8 gap-4">
                <div class="lg:col-span-5 mb-6">
                    <update-vendor-form :vendor="vendor" />
                </div>
                <div class="lg:col-span-3">
                    <contact-aside
                        contactable-type="vendors"
                        :contactable-id="vendor.id"
                        :contacts="vendor.contacts"
                    />
                </div>
            </div>
            <delete-vendor-form :vendor="vendor" />
        </div>
    </vendors-layout>
</template>

<script>
import VendorsLayout from "./VendorsLayout.vue";
import UpdateVendorForm from "@/Pages/Vendors/UpdateVendorForm.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import DeleteVendorForm from "./DeleteVendorForm.vue";
import ContactAside from "../Contacts/ContactAside.vue";
export default {
    components: {
        VendorsLayout,
        UpdateVendorForm,
        ButtonLink,
        DeleteVendorForm,
        ContactAside,
    },
    props: {
        vendor: Object,
    },
};
</script>
