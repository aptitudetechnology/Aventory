<template>
    <jet-form-section @submitted="updateLocation">
        <template #title>{{ location.name }}</template>
        <template #aside
            ><button-link :href="route('locations.show', location)"
                >View Blocks</button-link
            ></template
        >
        <template #form>
            <div class="grid col-span-6 gap-4">
                <div class="grid grid-cols-6 gap-2">
                    <div class="col-span-4 sm:col-span-5">
                        <jet-label for="name" value="Location Name" />
                        <jet-input
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autocomplete="organization"
                        />
                        <jet-input-error
                            :message="form.errors.name"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <jet-label for="location_code" value="Code" />
                        <jet-input
                            id="location_code"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.location_code"
                            required
                            autocomplete="off"
                        />
                        <jet-input-error
                            :message="form.errors.location_code"
                            class="mt-2"
                        />
                    </div>
                </div>
                <div class="grid gap-4">
                    <div class="col-span-3">
                        <jet-label for="address" value="Street Address" />
                        <jet-input
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            autocomplete="address"
                        />
                        <jet-input-error
                            :message="form.errors.address"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="city" value="City" />
                        <jet-input
                            id="city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.city"
                            autocomplete="address-level2"
                        />
                        <jet-input-error
                            :message="form.errors.city"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="state" value="State" />
                        <jet-input
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.state"
                            autocomplete="address-level1"
                        />
                        <jet-input-error
                            :message="form.errors.state"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <jet-label for="zip" value="Zip" />
                        <jet-input
                            id="zip"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.zip"
                            autocomplete="postal-code"
                        />
                        <jet-input-error
                            :message="form.errors.zip"
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
                >Save Location</jet-button
            >
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
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
        SelectBox,
        ButtonLink,
    },
    props: { location: Object },

    data() {
        return {
            form: this.$inertia.form({
                _method: "PATCH",
                name: this.location.name,
                location_code: this.location.location_code,
                address: this.location.address,
                city: this.location.city,
                state: this.location.state,
                zip: this.location.zip,
            }),
        };
    },

    methods: {
        updateLocation() {
            this.form.patch(route("locations.update", this.location), {
                errorBag: "updateLocation",
                preserveScroll: true,
            });
        },
    },
};
</script>
