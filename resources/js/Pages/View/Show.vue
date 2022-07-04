<template>
    <view-layout>
        <div class="grid gap-6">
            <div class="col-span-6">
                <product-details :product="product"></product-details>
            </div>

            <InventoryDetail :product="product" :productQuantities="productQuantities" :inventorySizes="inventorySizes"
                :inventory="inventory" :priceLevels="priceLevels" />
        </div>
    </view-layout>
</template>
<script>
import JetButton from "@/Jetstream/Button.vue";
import ViewLayout from "./ViewLayout.vue";
import ProductDetails from "@/Pages/Products/Components/ProductDetails.vue";
import InventoryDetail from "./Components/InventoryDetail.vue";
export default {
    components: {
        ProductDetails,
        JetButton,
        ViewLayout,
        InventoryDetail,
    },
    props: ['products', 'product', 'productQuantities', 'inventorySizes', 'inventory', 'priceLevels', 'selectedSize'],
};
</script>