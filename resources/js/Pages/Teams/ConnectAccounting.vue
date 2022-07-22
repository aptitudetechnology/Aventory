<template>
    <jet-section>
        <template #title> Connect your accounting system </template>

        <template #description>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
            dapibus diam ut felis varius lobortis. Nunc sodales aliquet felis,
            quis efficitur nulla iaculis in.
        </template>

        <jet-button
            type="button"
            :disabled="loading"
            @click="connect"
            v-if="!team.codat_company_id"
        >
            <loader :loading="loading" />
            Connect now
        </jet-button>

        <jet-button
            type="button"
            :disabled="loading"
            @click="disconnect"
            v-if="team.codat_company_id"
        >
            <loader :loading="loading" />
            Disconnect now
        </jet-button>
    </jet-section>
</template>

<script setup>
import JetSection from "@/Jetstream/Section";
import JetButton from "@/Jetstream/Button";
import Loader from "@/Components/Loader.vue";
import axios from "axios";
import { ref } from "vue";

const loading = ref(false);

const props = defineProps(["team"]);

function connect() {
    loading.value = true;
    const { team } = props;

    axios
        .post(route("teams.connect", { team }))
        .then(({ data: { redirectUrl } }) => {
            let url = new URL(redirectUrl);
            url.searchParams.append("teamId", team.id);

            window.location.href = url;
        })
        .finally(() => {
            loading.value = false;
        });
}

function disconnect() {
    loading.value = true;
    const { team } = props;

    axios
        .delete(route("teams.disconnect", { team }))
        .then(() => {
            console.log("disconnected");
        })
        .finally(() => {
            loading.value = false;
        });
}
</script>
