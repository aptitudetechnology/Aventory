<template>
    <jet-form-section @submitted="createCategory">
        <template #title>Create a Category</template>

        <template #description>
            Create a category for your products. Products in this category will
            automatically recieve the pricing and sizing set in this category.
        </template>

        <template #form>
            <div class="col-span-6">
                <div class="grid gap-4">
                    <div class="col-span-3">
                        <jet-label for="name" value="Category Name" />
                        <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autocomplete="off"
                        />
                        <jet-input-error
                            :message="form.errors.name"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3">
                        <jet-label
                            for="description"
                            value="Category description"
                        />
                        <text-area-input
                            id="description"
                            class="mt-1 block w-full"
                            v-model="form.description"
                        />
                        <jet-input-error
                            :message="form.errors.description"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                >Save Category</jet-button
            >
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        TextAreaInput,
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: "POST",
                name: "",
                description: null,
            }),
        };
    },

    methods: {
        createCategory() {
            this.form.post(route("categories.store"), {
                errorBag: "createCategory",
                preserveScroll: true,
            });
        },
    },
};
</script>
