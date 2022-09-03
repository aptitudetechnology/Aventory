<template>
    <div class="h-screen flex overflow-hidden bg-gray-50">
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                as="div"
                static
                class="fixed inset-0 flex z-40 md:hidden"
                @close="sidebarOpen = false"
                :open="sidebarOpen"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-600 bg-opacity-75"
                    />
                </TransitionChild>
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <div
                        class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="sidebarOpen = false"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XIcon
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <Link :href="route('dashboard')">
                                <jet-application-mark
                                    class="block h-9 w-auto"
                                />
                            </Link>
                        </div>
                        <div class="mt-5 flex-1 h-0 overflow-y-auto">
                            <sidebar-navlinks />
                        </div>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>
        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-72">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div
                    class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto"
                >
                    <div class="flex items-center flex-shrink-0 px-4">
                        <Link :href="route('dashboard')">
                            <jet-application-mark class="block w-auto" />
                        </Link>
                    </div>
                    <div class="mt-5 flex-grow flex flex-col">
                        <sidebar-navlinks />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <nav
                class="relative z-10 flex-shrink-0 flex justify-between md:justify-end h-16 bg-white shadow"
            >
                <!-- Mobile Menu Button -->
                <button
                    class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500 md:hidden"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
                </button>
                <!-- Profile and Teams settings menu -->
                <div class="flex justify-between h-16 px-4">
                    <div class="flex items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <!-- Teams Dropdown -->
                            <jet-dropdown
                                align="right"
                                width="60"
                                v-if="$page.props.jetstream.hasTeamFeatures"
                            >
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                                        >
                                            {{
                                                $page.props.user.current_team
                                                    .name
                                            }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <template
                                            v-if="
                                                $page.props.jetstream
                                                    .hasTeamFeatures
                                            "
                                        >
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-400"
                                            >
                                                Admin
                                            </div>

                                            <!-- Company Settings -->
                                            <jet-dropdown-link
                                                :href="
                                                    route(
                                                        'teams.show',
                                                        $page.props.user
                                                            .current_team
                                                    )
                                                "
                                            >
                                                Company Settings
                                            </jet-dropdown-link>

                                            <jet-dropdown-link
                                                :href="route('teams.create')"
                                                v-if="
                                                    $page.props.jetstream
                                                        .canCreateTeams
                                                "
                                            >
                                                Create New Company
                                            </jet-dropdown-link>

                                            <div
                                                class="border-t border-gray-100"
                                            ></div>

                                            <!-- Team Switcher -->
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-400"
                                            >
                                                Switch Company
                                            </div>

                                            <template
                                                v-for="team in $page.props.user
                                                    .all_teams"
                                                :key="team.id"
                                            >
                                                <form
                                                    @submit.prevent="
                                                        switchToTeam(team)
                                                    "
                                                >
                                                    <jet-dropdown-link
                                                        as="button"
                                                    >
                                                        <div
                                                            class="flex items-center"
                                                        >
                                                            <svg
                                                                v-if="
                                                                    team.id ==
                                                                    $page.props
                                                                        .user
                                                                        .current_team_id
                                                                "
                                                                class="mr-2 h-5 w-5 text-green-400"
                                                                fill="none"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                            >
                                                                <path
                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                ></path>
                                                            </svg>
                                                            <div>
                                                                {{ team.name }}
                                                            </div>
                                                        </div>
                                                    </jet-dropdown-link>
                                                </form>
                                            </template>
                                        </template>
                                    </div>
                                </template>
                            </jet-dropdown>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        v-if="
                                            $page.props.jetstream
                                                .managesProfilePhotos
                                        "
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                    >
                                        <img
                                            class="h-8 w-8 rounded-full object-cover"
                                            :src="
                                                $page.props.user
                                                    .profile_photo_url
                                            "
                                            :alt="$page.props.user.name"
                                        />
                                    </button>

                                    <span v-else class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                        >
                                            {{ $page.props.user.name }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400"
                                    >
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link
                                        :href="route('profile.show')"
                                    >
                                        Profile
                                    </jet-dropdown-link>

                                    <jet-dropdown-link
                                        :href="route('api-tokens.index')"
                                        v-if="
                                            $page.props.jetstream.hasApiFeatures
                                        "
                                    >
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Log Out
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>
                </div>
            </nav>
            <jet-banner />
            <!-- Page Content -->
            <slot></slot>
        </div>
    </div>
</template>

<script>
import {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { BellIcon, MenuAlt2Icon, XIcon } from "@heroicons/vue/outline";
import { SearchIcon } from "@heroicons/vue/solid";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import SidebarNavlinks from "@/Components/SidebarNavlinks.vue";

export default {
    components: {
        Dialog,
        DialogOverlay,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
        BellIcon,
        MenuAlt2Icon,
        SearchIcon,
        XIcon,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        SidebarNavlinks,
    },

    data() {
        return {
            sidebarOpen: false,
        };
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },

        logout() {
            this.$inertia.post(route("logout"));
        },
    },
};
</script>
