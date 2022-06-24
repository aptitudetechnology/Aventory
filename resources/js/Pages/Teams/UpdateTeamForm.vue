<template>
    <jet-form-section @submitted="updateTeam">
        <template #title> Company </template>

        <template #description>
            Update your base company information.
        </template>

        <template #form>
            <!-- Primary Account Manager Information -->
            <div class="col-span-6">
                <jet-label value="Primary Account Manager" />

                <div class="flex items-center mt-2">
                    <img
                        class="w-12 h-12 rounded-full object-cover"
                        :src="team.owner.profile_photo_url"
                        :alt="team.owner.name"
                    />

                    <div class="ml-4 leading-tight">
                        <div>{{ team.owner.name }}</div>
                        <div class="text-gray-700 text-sm">
                            {{ team.owner.email }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Name -->
            <div class="col-span-6 sm:col-span-3">
                <jet-label for="name" value="Company Name*" />

                <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    :disabled="!permissions.canUpdateTeam"
                />

                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 grid grid-cols-6 gap-y-2 gap-x-6">
                <h3 class="col-span-6 text-lg font-bold">
                    Contact Information
                </h3>
                <!-- Company Website -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="website" value="Company Website" />

                    <jet-input
                        id="website"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.website"
                        placeholder="https://example.com"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error
                        :message="form.errors.website"
                        class="mt-2"
                    />
                </div>

                <!-- Company Email -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="email" value="Company Email" />

                    <jet-input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        placeholder="yourcompany@email.com"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error
                        :message="form.errors.email"
                        class="mt-2"
                    />
                </div>

                <!-- Company Phone -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="phone" value="Company Phone" />

                    <jet-input
                        id="phone"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="(123) 456-7890"
                        v-model="form.phone"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error
                        :message="form.errors.phone"
                        class="mt-2"
                    />
                </div>
            </div>

            <div class="col-span-6 grid grid-cols-6 gap-y-2 gap-x-6">
                <h3 class="col-span-6 text-lg font-bold">Company Address</h3>
                <!-- Company Address -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="address_line_1" value="Address Line 1" />

                    <jet-input
                        id="address_line_1"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.address_line_1"
                        placeholder="123 Main St"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error
                        :message="form.errors.address_line_1"
                        class="mt-2"
                    />
                </div>

                <!-- Company Address 2 -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="address_line_2" value="Address Line 2" />

                    <jet-input
                        id="address_line_2"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.address_line_2"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error
                        :message="form.errors.address_line_2"
                        class="mt-2"
                    />
                </div>

                <!-- Company City -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="city" value="Company City" />

                    <jet-input
                        id="city"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.city"
                        placeholder="New York"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error :message="form.errors.city" class="mt-2" />
                </div>

                <!-- Company State -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="state" value="Company State" />

                    <jet-input
                        id="state"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.state"
                        placeholder="NY"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error
                        :message="form.errors.state"
                        class="mt-2"
                    />
                </div>

                <!-- Company Zip -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="zip" value="Company Zip" />

                    <jet-input
                        id="zip"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.zip"
                        placeholder="12345"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error :message="form.errors.zip" class="mt-2" />
                </div>

                <!-- Company Country -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="country" value="Company Country" />

                    <jet-input
                        id="country"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.country"
                        placeholder="United States"
                        :disabled="!permissions.canUpdateTeam"
                    />

                    <jet-input-error
                        :message="form.errors.country"
                        class="mt-2"
                    />
                </div>
            </div>
        </template>

        <template #actions v-if="permissions.canUpdateTeam">
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import HeadingTwo from "@/Components/Headings/HeadingTwo.vue";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        HeadingTwo,
    },

    props: ["team", "permissions"],

    data() {
        return {
            form: this.$inertia.form({
                name: this.team.name,
                website: this.team.website,
                email: this.team.email,
                phone: this.team.phone,
                address_line_1: this.team.address_line_1,
                address_line_2: this.team.address_line_2,
                city: this.team.city,
                state: this.team.state,
                zip: this.team.zip,
                country: this.team.country,
            }),
        };
    },

    methods: {
        updateTeam() {
            this.form.put(route("teams.update", this.team), {
                errorBag: "updateTeam",
                preserveScroll: true,
            });
        },
    },
};
</script>
