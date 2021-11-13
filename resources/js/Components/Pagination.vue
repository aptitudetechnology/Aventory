<template>
    <nav
        v-if="items.links.length > 3"
        class="
            border-t border-gray-200
            px-4
            flex
            items-center
            justify-between
            sm:px-0
        "
    >
        <div class="-mt-px w-0 flex-1 flex">
            <div
                v-if="!items.prev_page_url"
                class="
                    border-t-2 border-transparent
                    pt-4
                    pr-1
                    inline-flex
                    items-center
                    text-sm
                    font-medium
                    text-gray-500
                    cursor-not-allowed
                "
            >
                <svg
                    class="mr-3 h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 16l-4-4m0 0l4-4m-4 4h18"
                    ></path>
                </svg>

                Previous
            </div>
            <inertia-link
                v-else
                :href="items.prev_page_url"
                class="
                    border-t-2 border-transparent
                    pt-4
                    pr-1
                    inline-flex
                    items-center
                    text-sm
                    font-medium
                    text-gray-500
                    hover:text-gray-700 hover:border-gray-300
                "
            >
                <svg
                    class="mr-3 h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 16l-4-4m0 0l4-4m-4 4h18"
                    ></path>
                </svg>
                Previous
            </inertia-link>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <template v-for="link in links" :key="link.label">
                <inertia-link
                    v-if="link.url"
                    :href="link.url"
                    class="
                        border-transparent
                        text-gray-500
                        hover:text-gray-700 hover:border-gray-300
                        border-t-2
                        pt-4
                        px-4
                        inline-flex
                        items-center
                        text-sm
                        font-medium
                    "
                    :class="{
                        'border-indigo-500 text-indigo-600': link.active,
                    }"
                >
                    {{ link.label }}
                </inertia-link>
                <span
                    v-else
                    class="
                        border-transparent
                        text-gray-500
                        border-t-2
                        pt-4
                        px-4
                        inline-flex
                        items-center
                        text-sm
                        font-medium
                    "
                >
                    ...
                </span>
            </template>
        </div>
        <div class="-mt-px w-0 flex-1 flex justify-end">
            <div
                v-if="!items.next_page_url"
                class="
                    border-t-2 border-transparent
                    pt-4
                    pl-1
                    inline-flex
                    items-center
                    text-sm
                    font-medium
                    text-gray-500
                    cursor-not-allowed
                "
            >
                Next
                <svg
                    class="ml-3 h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3"
                    ></path>
                </svg>
            </div>
            <inertia-link
                v-else
                :href="items.next_page_url"
                class="
                    border-t-2 border-transparent
                    pt-4
                    pl-1
                    inline-flex
                    items-center
                    text-sm
                    font-medium
                    text-gray-500
                    hover:text-gray-700 hover:border-gray-300
                "
            >
                Next
                <svg
                    class="ml-3 h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3"
                    ></path>
                </svg>
            </inertia-link>
        </div>
    </nav>
</template>

<script>
export default {
    props: {
        items: {
            type: Object,
        },
    },
    computed: {
        links() {
            //filter all the item links where the label does not include the phrase Next or Previous
            return this.items.links.filter(
                (link) =>
                    !link.label.includes("Next") &&
                    !link.label.includes("Previous")
            );
        },
    },
    onMounted() {
        console.log(this.items.links);
    },
};
</script>
