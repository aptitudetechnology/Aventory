<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-gray-900">
            {{ price.size.name }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <jet-label for="unit_price" class="sr-only" value="Unit Price" />
            <div class="mt-1 relative max-w-xs rounded-md shadow-sm">
                <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                >
                    $
                </div>
                <jet-input
                    @change="updateProductPrice"
                    id="unit_price"
                    type="number"
                    step="0.01"
                    class="block w-full pl-6"
                    v-model="form.unit_price"
                    required
                />
            </div>
            <jet-input-error :message="form.errors.unit_price" class="mt-2" />
        </td>

        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex space-x-4">
                <jet-checkbox
                    @change="updateProductPrice"
                    v-model="form.show_on_availability"
                    :checked="form.show_on_availability"
                    :id="'show_on_availability' + price.id"
                />
                <JetLabel :for="'show_on_availability' + price.id">{{
                    form.show_on_availability ? "Yes" : "No"
                }}</JetLabel>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <DeletePrice :price="price" />
        </td>
    </tr>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import DeletePrice from "./DeletePrice.vue";
export default {
    components: {
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetCheckbox,
        DeletePrice,
    },
    props: { price: Object },

    data() {
        return {
            form: this.$inertia.form({
                _method: "PATCH",
                product_id: this.price.product_id,
                size_id: this.price.size_id,
                unit_price: this.price.unit_price,
                custom_price: this.price.custom_price,
                show_on_availability: this.price.show_on_availability,
            }),
        };
    },
    methods: {
        updateProductPrice() {
            this.form.patch(route("prices.update", this.price), {
                preserveScroll: true,
                preserveState: true,
            });
        },
    },
};
</script>
