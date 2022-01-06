<template>
    <purchases-layout>
        <div>
            <div class="space-y-6">
                <update-purchase-form :purchase="purchase" />
                <purchase-items
                    :purchase="purchase"
                    :purchaseItems="purchaseItems"
                />
                <delete-purchase-form :purchase="purchase" />
            </div>
        </div>
    </purchases-layout>
</template>

<script>
import PurchasesLayout from "./PurchasesLayout.vue";
import ButtonLink from "@/Components/Links/ButtonLink";

import UpdatePurchaseForm from "./Components/UpdatePurchaseForm";
import DeletePurchaseForm from "./Components/DeletePurchaseForm.vue";
import PurchaseItems from "./Components/PurchaseItems.vue";
export default {
    components: {
        PurchasesLayout,
        UpdatePurchaseForm,
        ButtonLink,
        DeletePurchaseForm,
        PurchaseItems,
    },
    props: {
        purchase: Object,
        purchaseItems: Array,
    },
};
</script>
