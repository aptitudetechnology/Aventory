<template>
    <customers-layout>
        <create-customer-form />
    </customers-layout>
</template>

<script>
import CreateCustomerForm from "@/Pages/Customers/CreateCustomerForm.vue";
import CustomersLayout from "./CustomersLayout.vue";
export default {
    components: {
        CreateCustomerForm,
        CustomersLayout,
    },
};
</script>
