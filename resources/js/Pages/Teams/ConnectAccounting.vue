<template>
    <jet-section @submitted="updateTeam">
        <template #title> Connect your accounting system </template>

        <template #description>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
            dapibus diam ut felis varius lobortis. Nunc sodales aliquet felis,
            quis efficitur nulla iaculis in.
        </template>

        <jet-button @click="connect"> Connect now </jet-button>
    </jet-section>
</template>

<script setup>
import JetSection from "@/Jetstream/Section";
import JetButton from "@/Jetstream/Button";
import axios from "axios";

function connect() {
    axios.post("/teams/connect").then(({ data: { redirectUrl } }) => {
        window.open(redirectUrl, '_blank');
    });
}
</script>
