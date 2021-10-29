<template>
    <div
        v-if="sizes.length > 0"
        class="flex flex-col max-w-screen-sm min-w-max"
    >
        <div class="shadow border-b border-gray-200 sm:rounded-lg">
            <table-table>
                <thead class="bg-gray-50">
                    <tr>
                        <table-h>Name</table-h>
                        <table-h>Next Size</table-h>
                        <table-h>Delete</table-h>
                        <table-h>Sort</table-h>
                    </tr>
                </thead>
                <draggable
                    tag="tbody"
                    v-model="sizes"
                    handle=".handle"
                    item-key="id"
                    v-bind="dragOptions"
                    @change="updateSort"
                    class="divide-y divide-gray-200"
                >
                    <template #item="{ element }">
                        <tr>
                            <update-size-form :size="element" />
                            <table-d
                                ><delete-size-component :size="element"
                            /></table-d>
                            <table-d class="cursor-pointer handle"
                                ><svg
                                    class="rotate-45 mx-auto w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"
                                    ></path></svg
                            ></table-d>
                        </tr>
                    </template>
                </draggable>
            </table-table>
        </div>
    </div>
    <empty-state
        v-else
        heading="No Sizes"
        subtitle="Get started by creating a new product size."
        button-text="New Size"
        :href="route('sizes.create')"
    />
</template>

<script>
import EmptyState from "@/Components/EmptyState.vue";
import UpdateSizeForm from "./UpdateSizeForm.vue";
import draggable from "vuedraggable";
import DeleteSizeComponent from "./DeleteSizeComponent.vue";
import { Inertia } from "@inertiajs/inertia";
import TableH from "@Components/TableH.vue";
import TableD from "@Components/TableD.vue";
import TableTable from "@/Components/TableTable.vue";
export default {
    components: {
        EmptyState,
        UpdateSizeForm,
        draggable,
        DeleteSizeComponent,
        TableH,
        TableD,
        TableTable,
    },
    data() {
        return {
            sizes: this.$page.props.sizes,
            drag: false,
            saving: false,
        };
    },
    methods: {
        updateSort() {
            clearTimeout(this.saving);
            this.sizes.map((size, index) => {
                size.sort_num = index + 1;
            });

            this.saving = setTimeout(() => this.saveOrderChanges(), 2000);
        },
        saveOrderChanges() {
            Inertia.put(route("sizes.updateOrder"), { sizes: this.sizes });
        },
    },
    computed: {
        dragOptions() {
            return {
                animation: 200,
                group: "description",
                disabled: false,
                ghostClass: "ghost",
            };
        },
    },
};
</script>

<style>
.button {
    margin-top: 35px;
}
.flip-list-move {
    transition: transform 0.5s;
}
.no-move {
    transition: transform 0s;
}
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
.list-group {
    min-height: 20px;
}
.list-group-item {
    cursor: move;
}
.list-group-item i {
    cursor: pointer;
}
</style>
