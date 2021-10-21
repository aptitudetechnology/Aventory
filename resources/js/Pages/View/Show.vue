<template>
    <view-layout>
        <div class="grid gap-6">
            <product-details
                class="col-span-6"
                :product="product"
            ></product-details>
            <InventorySizes />
        </div>
    </view-layout>
</template>
<script>
import JetButton from "@/Jetstream/Button.vue";
import ViewLayout from "./ViewLayout.vue";
import ProductDetails from "@/Pages/Products/Components/ProductDetails.vue";
import InventorySizes from "./Components/InventorySizes.vue";
export default {
    components: {
        ProductDetails,
        JetButton,
        ViewLayout,
        InventorySizes,
    },
    props: ["product"],
};
</script>
