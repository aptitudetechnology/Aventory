<template>
    <view-layout>
        <div class="grid gap-6">
            <div class="col-span-6">
                <product-details :product="product"></product-details>
            </div>

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
