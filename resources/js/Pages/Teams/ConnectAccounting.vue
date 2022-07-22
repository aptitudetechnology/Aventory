<template>
    <jet-section>
        <template #title> Connect your accounting system </template>

        <template #description>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
            dapibus diam ut felis varius lobortis. Nunc sodales aliquet felis,
            quis efficitur nulla iaculis in.
        </template>

        <jet-button @click="$emit('connect', team.id)" v-if="!team.codat_company_id">
            Connect now
        </jet-button>

        <jet-button @click="$emit('disconnect', team.id)" v-if="team.codat_company_id">
            Disconnect now
        </jet-button>
    </jet-section>
</template>

<script setup>
import JetSection from "@/Jetstream/Section";
import JetButton from "@/Jetstream/Button";
import axios from "axios";

defineProps(["team"]);

defineEmits({
    connect(teamId) {
        axios
            .post(route("teams.connect", { team: teamId }))
            .then(({ data: { redirectUrl } }) => {
                let url = new URL(redirectUrl);
                url.searchParams.append("teamId", teamId);

                window.location.href = url;
            });
    },
});
</script>
