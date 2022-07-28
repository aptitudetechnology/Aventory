<template>
    <jet-section>
        <template #title> Connect your accounting system </template>

        <template #description>
            Sync your orders and quotes with your accounting platform of choice, including QuickBooks Online or QuickBooks Desktop. 
        </template>

        <jet-button
            type="button"
            :disabled="isLoading"
            @click="connect"
            v-if="!connected"
        >
            <loader :loading="isLoading" />
            Connect now
        </jet-button>

        <jet-button
            type="button"
            :disabled="isLoading"
            @click="isDisconnectModalOpen = true"
            v-if="connected"
        >
            <loader :loading="isLoading" />
            Disconnect now
        </jet-button>
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
import JetButton from "@/Jetstream/Button.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import Loader from "@/Components/Loader.vue";
import axios from "axios";
import { ref } from "vue";

const isLoading = ref(false);
const isDisconnectModalOpen = ref(false);
const props = defineProps(["team"]);
const connected = ref(!!props.team.codat_company_id);

function connect() {
    isLoading.value = true;
    const { team } = props;

    axios
        .post(route("teams.connect", { team }))
        .then(({ data: { redirectUrl } }) => {
            let url = new URL(redirectUrl);
            url.searchParams.append("teamId", team.id);
            window.location.href = url;

            connected.value = true;
        })
        .finally(() => {
            isLoading.value = false;
        });
}

function disconnect() {
    isLoading.value = true;
    isDisconnectModalOpen.value = false;
    const { team } = props;

    axios
        .delete(route("teams.disconnect", { team }))
        .then(() => {
            connected.value = false;
        })
        .finally(() => {
            isLoading.value = false;
        });
}
</script>
