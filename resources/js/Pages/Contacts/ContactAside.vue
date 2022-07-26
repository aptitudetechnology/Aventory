<template>
    <div class="my-5 md:mt-0">
        <div class="py-5 bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="px-4 sm:px-6">
                <jet-section-title>
                    <template #title>Contacts</template>
                    <template v-if="contacts.length > 0" #aside>
                        <create-contact-component
                            :contactable-type="contactableType"
                            :contactable-id="contactableId"
                        />
                    </template>
                </jet-section-title>
            </div>

            <div class="divide-y divide-gray-200 mt-4">
                <update-contact-component
                    v-for="contact in contacts"
                    :key="contact.id"
                    :contact="contact"
                />
                <create-contact-component
                    class="px-4 sm:px-6"
                    v-if="!contacts.length"
                    :contactable-type="contactableType"
                    :contactable-id="contactableId"
                />
            </div>
        </div>
    </div>
</template>
<script>
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import CreateContactComponent from "./CreateContactComponent.vue";
import UpdateContactComponent from "./UpdateContactComponent.vue";
export default {
    props: { contacts: Array, contactableType: String, contactableId: Number },
    components: {
        JetSectionTitle,
        CreateContactComponent,
        UpdateContactComponent,
    },
};
</script>
