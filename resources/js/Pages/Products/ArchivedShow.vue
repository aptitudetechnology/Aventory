<template>
    <products-layout>
        <product-details :product="product"></product-details>
        <restore-product-form
            :product="product"
            class="mt-6"
        ></restore-product-form>
    </products-layout>
</template>

<script>
import { PaperClipIcon } from "@heroicons/vue/solid";
import ProductsLayout from "./ProductsLayout.vue";
import ProductDetails from "./Components/ProductDetails";
import RestoreProductForm from "./RestoreProductForm.vue";
export default {
    components: {
        PaperClipIcon,
        ProductsLayout,
        ProductDetails,
        RestoreProductForm,
    },
    props: { product: Object },
};
</script>
