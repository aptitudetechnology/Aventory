<template>
    <div>
        <jet-button @click="creatingPlaces = true">Add Places</jet-button>
        <jet-dialog-modal
            :show="creatingPlaces"
            @close="creatingPlaces = false"
        >
            <template #title>Add Plant Places</template>

            <template #description>
                Create places in block {{ block.name }} to assign individual
                inventory to.
            </template>

            <template #content>
                <form
                    @submit.prevent="createPlaces"
                    @keyup.enter="createPlaces"
                >
                    <div class="col-span-6">
                        <div class="grid gap-4">
                            <div class="col-span-4 sm:col-span-2">
                                <jet-label
                                    for="num_rows"
                                    value="Number of Rows"
                                />
                                <jet-input
                                    id="num_rows"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.num_rows"
                                    required
                                    autocomplete="off"
                                />
                                <jet-input-error
                                    :message="form.errors.num_rows"
                                    class="mt-2"
                                />
                            </div>
                            <div class="col-span-4 sm:col-span-2">
                                <jet-label
                                    for="starting_row_num"
                                    value="Starting Row Number"
                                />
                                <jet-input
                                    id="starting_row_num"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.starting_row_num"
                                    autocomplete="off"
                                />
                                <jet-input-error
                                    :message="form.errors.starting_row_num"
                                    class="mt-2"
                                />
                            </div>
                            <div class="col-span-4 sm:col-span-2">
                                <jet-label
                                    for="num_plants_per_row"
                                    value="Plants Per Row"
                                />
                                <jet-input
                                    id="num_plants_per_row"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.num_plants_per_row"
                                    autocomplete="off"
                                />
                                <jet-input-error
                                    :message="form.errors.num_plants_per_row"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <div class="flex justify-between w-full">
                    <jet-secondary-button
                        type="button"
                        @click="creatingPlaces = false"
                        >Cancel</jet-secondary-button
                    >
                    <jet-button
                        type="submit"
                        @click="createPlaces"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        >Save Places</jet-button
                    >
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        TextAreaInput,
    },
    props: { block: Object },

    data() {
        return {
            creatingPlaces: false,
            form: this.$inertia.form({
                _method: "POST",
                block_id: this.block.id,
                num_rows: null,
                starting_row_num: null,
                num_plants_per_row: null,
            }),
        };
    },

    methods: {
        createPlaces() {
            this.form.post(route("places.store"), {
                preserveScroll: false,
                preserveState: false,
            });
        },
    },
};
</script>
