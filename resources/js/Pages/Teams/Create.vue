<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Team
            </h2>
        </template>

        <div>
            <div class="h-full overflow-y-auto max-w-7xl py-10 sm:px-6 lg:px-8">
                <create-team-form />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateTeamForm from "./CreateTeamForm.vue";

export default {
    components: {
        AppLayout,
        CreateTeamForm,
    },
};
</script>
