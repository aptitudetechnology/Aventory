<template>
    <jet-form-section @submitted="createBlock">
        <template #title>Create a Block</template>

        <template #description>
            Create a new nursery block where you sell or grow plants.
        </template>

        <template #form>
            <div class="grid col-span-6 gap-4">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6">
                        <jet-label for="name" value="Block Name" />
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
                    <div class="col-span-5">
                        <SelectBox
                            :items="locations"
                            :selectedItem="selectedLocation"
                            v-model="selectedLocation"
                            labelValue="Select Nursery Location"
                        />
                        <jet-input-error
                            :message="form.errors.nursery_location_id"
                            class="mt-2"
                        />
                    </div>

                    <SwitchGroup
                        as="div"
                        class="flex items-center justify-between col-span-6"
                    >
                        <span class="flex-grow flex flex-col mr-2">
                            <SwitchLabel as="span" class="text-sm text-gray-900"
                                >Has Places?</SwitchLabel
                            >
                            <SwitchDescription
                                as="span"
                                class="text-sm text-gray-500"
                                >Indicate whether this block has individual
                                places for storing inventory by row and pot
                                number.</SwitchDescription
                            >
                        </span>
                        <Switch
                            v-model="form.has_places"
                            :class="[
                                form.has_places
                                    ? 'bg-green-600'
                                    : 'bg-gray-200',
                                'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500',
                            ]"
                        >
                            <span
                                aria-hidden="true"
                                :class="[
                                    form.has_places
                                        ? 'translate-x-5'
                                        : 'translate-x-0',
                                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                ]"
                            />
                        </Switch>
                    </SwitchGroup>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-button
                type="submit"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                >Save Block</jet-button
            >
        </template>
    </jet-form-section>
</template>

<script>
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";

import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

import SelectBox from "@/Components/Forms/SelectBox.vue";

export default {
    components: {
        Switch,
        SwitchDescription,
        SwitchGroup,
        SwitchLabel,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,

        SelectBox,
    },

    data() {
        return {
            locations: this.$page.props.locations,
            selectedLocation: null,
            form: this.$inertia.form({
                _method: "POST",
                name: "",
                has_places: false,
                nursery_location_id: null,
            }),
        };
    },
    watch: {
        selectedLocation(location) {
            this.form.nursery_location_id = location.id;
        },
    },

    methods: {
        createBlock() {
            this.form.post(route("blocks.store"), {
                errorBag: "createBlock",
                preserveScroll: true,
            });
        },
    },
};
</script>
