<template>
    <jet-section>
        <template #title> Connect your accounting system </template>

        <template #description>
            Sync your orders and quotes with your accounting platform of choice,
            including QuickBooks Online or QuickBooks Desktop.
        </template>

        <template v-if="team.accounting_connected">
            <div
                class="px-4 py-4 text-red-800 bg-red-200 rounded-md mb-4"
                role="alert"
            >
                If you disconnect, you will lose all data.
            </div>

            <button
                type="button"
                class="btn btn-error"
                @click="isDisconnectModalOpen = true"
            >
                Disconnect now
            </button>
        </template>
        <a :href="team.codat_company_link" class="btn" v-else> Connect now </a>
    </jet-section>

    <jet-confirmation-modal
        :show="isDisconnectModalOpen"
        @close="isDisconnectModalOpen = false"
    >
        <template #title> Disconnect </template>

        <template #content>
            Are you sure you want to disconnect accounting?
        </template>

        <template #footer>
            <jet-secondary-button @click="isDisconnectModalOpen = false">
                Cancel
            </jet-secondary-button>

            <jet-danger-button class="ml-2" @click="disconnect">
                Disconnect
            </jet-danger-button>
        </template>
    </jet-confirmation-modal>
</template>

<script setup>
import JetSection from "@/Jetstream/Section.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const isDisconnectModalOpen = ref(false);

defineProps(["team"]);

function disconnect() {
    isDisconnectModalOpen.value = false;
    Inertia.patch(route("codat.disconnect"));
}
</script>
