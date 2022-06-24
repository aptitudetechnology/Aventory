<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Company Settings
            </h2>
        </template>

        <div class="overflow-y-auto h-full">
            <div class="max-w-7xl py-10 sm:px-6 lg:px-8">
                <update-team-form :team="team" :permissions="permissions" />

                <team-member-manager
                    class="mt-10 sm:mt-0"
                    :team="team"
                    :available-roles="availableRoles"
                    :user-permissions="permissions"
                />

                <template
                    v-if="permissions.canDeleteTeam && !team.personal_team"
                >
                    <jet-section-border />

                    <delete-team-form class="mt-10 sm:mt-0" :team="team" />
                </template>
            </div>
        </div>
    </app-layout>
</template>

<script>
import TeamMemberManager from "./TeamMemberManager";
import AppLayout from "@/Layouts/AppLayout";
import DeleteTeamForm from "./DeleteTeamForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import UpdateTeamForm from "./UpdateTeamForm";

export default {
    props: ["team", "availableRoles", "permissions"],

    components: {
        AppLayout,
        DeleteTeamForm,
        JetSectionBorder,
        TeamMemberManager,
        UpdateTeamForm,
    },
};
</script>
