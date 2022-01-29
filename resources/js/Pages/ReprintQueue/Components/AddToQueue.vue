<template>
    <jet-button @click="addToQueue">Add to Queue</jet-button>
    <dialog-modal :show="addingToQueue" @close="addingToQueue = false">
        <template #title>Add to Queue</template>
        <template #content>
            <form @keydown.enter="save" class="w-full grid gap-4">
                <div class="form-group">
                    <jet-label for="inventory_id">Inventory ID</jet-label>
                    <jet-input
                        class="w-full"
                        id="inventory_id"
                        type="text"
                        v-model="form.inventory"
                    />
                    <jet-input-error
                        class="mt-2"
                        :message="form.errors.inventory"
                    />
                </div>

                <div class="form-group">
                    <jet-label for="quantity">Quantity to Print</jet-label>
                    <jet-input
                        class="w-full"
                        id="quantity"
                        type="number"
                        v-model="form.quantity"
                    />
                    <jet-input-error
                        class="mt-2"
                        :message="form.errors.quantity"
                    />
                </div>
            </form>
        </template>

        <template #footer>
            <div class="flex items-center justify-between">
                <jet-button class="mr-4" @click="addingToQueue = false"
                    >Cancel</jet-button
                >
                <jet-button type="submit" @click="save">Add</jet-button>
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import DialogModal from "@/Jetstream/DialogModal.vue";
export default {
    components: {
        DialogModal,
    },
    data() {
        return {
            addingToQueue: false,
            form: this.$inertia.form({
                inventory: null,
                quantity: 1,
            }),
        };
    },
    methods: {
        addToQueue() {
            this.addingToQueue = true;
        },
        save() {
            this.form.post(route("reprint-queue.store"), {
                onSuccess: () => {
                    this.addingToQueue = false;
                },
            });
        },
    },
};
</script>
