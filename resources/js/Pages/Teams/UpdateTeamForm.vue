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
                    <input
                        type="file"
                        ref="logo"
                        class="hidden"
                        @change="uploadLogo"
                    />
                    <div class="relative h-16">
                        <img
                            class="h-full object-cover"
                            :src="logoUrl"
                            :alt="team.name"
                        />
                        <button
                            type="button"
                            class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 border border-2 border-gray-400 text-gray-500 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-gray-100"
                            :disabled="isLogoUploading"
                            @click="chooseLogo"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14.078 4.232l-12.64 12.639-1.438 7.129 7.127-1.438 12.641-12.64-5.69-5.69zm-10.369 14.893l-.85-.85 11.141-11.125.849.849-11.14 11.126zm2.008 2.008l-.85-.85 11.141-11.125.85.85-11.141 11.125zm18.283-15.444l-2.816 2.818-5.691-5.691 2.816-2.816 5.691 5.689z"
                                />
                            </svg>
                        </button>
                    </div>

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
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import HeadingTwo from "@/Components/Headings/HeadingTwo.vue";
import axios from "axios";

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
            logoUrl: this.team.logo_url,
            isLogoUploading: false,
        };
    },

    methods: {
        updateTeam() {
            this.form.put(route("teams.update", this.team), {
                errorBag: "updateTeam",
                preserveScroll: true,
            });
        },
        chooseLogo() {
            this.$refs.logo.click();
        },
        uploadLogo(e) {
            const config = {
                headers: { "Content-Type": "multipart/form-data" },
            };

            const formData = new FormData();
            formData.append("logo", e.target.files[0]);

            this.isLogoUploading = true;
            axios
                .post(route("teams.logo"), formData, config)
                .then(({ data }) => {
                    this.logoUrl = data.logo_url;
                })
                .finally(() => {
                    this.isLogoUploading = false;
                });
        },
    },
};
</script>
