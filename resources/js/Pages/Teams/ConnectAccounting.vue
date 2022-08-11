<template>
    <jet-section>
        <template #title> Connect your accounting system </template>

        <template #description>
            Sync your orders and quotes with your accounting platform of choice,
            including QuickBooks Online or QuickBooks Desktop.
        </template>

        <a :href="team.codat_company_link" class="btn"> Connect now </a>

        <ul
            class="w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white mt-5"
        >
            <li
                class="py-4 px-4 w-full border-b border-gray-200 dark:border-gray-600"
                v-for="connection in accountingConnections"
            >
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span
                            class="inline-flex justify-center items-center w-5 h-5 text-xs font-bold text-white rounded-full border-2 border-white dark:border-gray-900 mr-5"
                            :class="statusClass(connection)"
                            :title="connection.status"
                        ></span>
                        {{ connection.platformName }}
                    </div>
                    <a
                        :href="connection.linkUrl"
                        v-if="connection.status !== 'Linked'"
                        class="btn btn-sm"
                    >
                        Connect
                    </a>
                    <button
                        v-else-if="connection.status === 'Linked'"
                        class="btn btn-error btn-sm"
                        @click="
                            isDisconnectModalOpen = true;
                            currentConnectionId = connection.id;
                        "
                    >
                        Disconnect
                    </button>
                </div>
            </li>
        </ul>
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
const currentConnectionId = ref("");
const props = defineProps(["team"]);
const accountingConnections = props.team.connections?.filter(
    (c) => c.sourceType === "Accounting"
);

function statusClass(connection) {
    if (connection.status === "Deauthorized") {
        return "bg-error";
    } else if (connection.status === "Linked") {
        return "bg-success";
    } else if (connection.status === "Unlinked") {
        return "bg-primary";
    } else if (connection.status === "PendingAuth") {
        return "bg-warning";
    }
}

function disconnect() {
    isDisconnectModalOpen.value = false;
    Inertia.patch(
        route("codat.disconnect", { connectionId: currentConnectionId.value })
    );
}
</script>
