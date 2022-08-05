<template>
    <jet-form-section @submitted="updateFeature">
        <template #title>{{ feature.name }}</template>

        <template #description>
            Update this feature. Plants containing this feature will have the
            changes reflected immediately.
        </template>

        <template #form>
            <div class="col-span-6">
                <div class="grid gap-4">
                    <div class="col-span-3">
                        <jet-label for="name" value="Feature Name" />
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
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="{ 'opacity-25': form.processing || !form.isDirty }"
                :disabled="form.processing || !form.isDirty"
                >Save Feature</jet-button
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
    props: { feature: Object },

    data() {
        return {
            form: this.$inertia.form({
                _method: "PATCH",
                name: this.feature.name,
            }),
        };
    },
    methods: {
        updateFeature() {
            this.form.patch(route("features.update", this.feature), {
                errorBag: "updateFeature",
                preserveScroll: true,
                preserveState: false,
            });
        },
    },
};
</script>
