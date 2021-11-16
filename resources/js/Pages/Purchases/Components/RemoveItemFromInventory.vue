<template>
    <div>
        <RemoveButton
            title="Remove from inventory"
            @click="removingInventoryItem = true"
        />
        <jet-dialog-modal
            :show="removingInventoryItem"
            @close="removingInventoryItem = false"
        >
            <template #title>Remove from Inventory</template>

            <template #description>
                Remove this item from inventory? All associated inventory will
                be removed! Do this if you need to update the quantity
                confirmed, made a mistake, or other details.
            </template>

            <template #content>
                <form
                    @submit.prevent="removeItemFromInventory"
                    @keydown.enter="removeItemFromInventory"
                >
                    <div class="col-span-6 grid gap-4"></div>
                </form>
            </template>

            <template #footer>
                <div class="flex justify-between w-full">
                    <jet-secondary-button
                        type="button"
                        @click="removingInventoryItem = false"
                        >Cancel</jet-secondary-button
                    >
                    <div>
                        <jet-danger-button
                            type="submit"
                            @click="removeItemFromInventory"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            >Yes, remove item</jet-danger-button
                        >
                    </div>
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import JetDangerButton from "@/Jetstream/DangerButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

import RemoveButton from "@Components/Buttons/RemoveButton";

export default {
    components: {
        JetDangerButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,

        RemoveButton,
    },
    props: { item: Object },

    data() {
        return {
            removingInventoryItem: false,
            form: this.$inertia.form({
                _method: "POST",
                item_id: this.item.id,
            }),
        };
    },
    watch: {
        selectedType() {
            this.form.type = this.selectedType.value;
        },
    },

    methods: {
        removeItemFromInventory() {
            this.form.delete(route("delete-inventory-purchase-item"), {
                preserveScroll: true,
                preserveState: false,
            });
        },
    },
};
</script>
