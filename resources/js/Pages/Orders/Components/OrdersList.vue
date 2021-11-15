<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
            <li v-for="order in orders.data" :key="order.id">
                <a href="#" class="block hover:bg-gray-50">
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <p
                                class="
                                    text-sm
                                    font-medium
                                    text-indigo-600
                                    truncate
                                "
                            >
                                {{ order.customer.name }}
                            </p>

                            <div class="ml-2 flex-shrink-0 flex">
                                <p
                                    class="
                                        px-2
                                        inline-flex
                                        text-xs
                                        leading-5
                                        font-semibold
                                        rounded-full
                                        bg-green-100
                                        text-green-800
                                    "
                                >
                                    {{ order.paymentStatus?.name }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-2 sm:flex sm:justify-between">
                            <div class="sm:flex">
                                <p
                                    class="
                                        flex
                                        items-center
                                        text-sm text-gray-500
                                    "
                                >
                                    #
                                    {{ order.id }}
                                </p>
                                <div
                                    class="
                                        mt-2
                                        flex
                                        items-center
                                        text-sm text-gray-500
                                        sm:mt-0
                                    "
                                >
                                    <CalendarIcon
                                        class="
                                            flex-shrink-0
                                            mr-1.5
                                            h-5
                                            w-5
                                            text-gray-400
                                        "
                                        aria-hidden="true"
                                    />
                                    <p>
                                        <time :datetime="order.date">{{
                                            order.date
                                        }}</time>
                                    </p>
                                </div>
                            </div>
                            <div
                                class="
                                    mt-2
                                    flex
                                    items-center
                                    text-sm text-gray-500
                                    sm:mt-0
                                "
                            >
                                <CalendarIcon
                                    class="
                                        flex-shrink-0
                                        mr-1.5
                                        h-5
                                        w-5
                                        text-gray-400
                                    "
                                    aria-hidden="true"
                                />
                                <p>
                                    <time :datetime="order.date">{{
                                        order.date
                                    }}</time>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import {
    CalendarIcon,
    LocationMarkerIcon,
    UsersIcon,
} from "@heroicons/vue/solid";
import moment from "moment";

export default {
    components: {
        CalendarIcon,
        LocationMarkerIcon,
        UsersIcon,
    },
    props: {
        orders: {
            type: Object,
        },
    },
    methods: {
        formatDate: (value) => moment(value).format("MM/DD/YYYY"),
    },
};
</script>
