
<template>
  <div v-if="sizes.length > 0" class="flex flex-col max-w-screen-sm min-w-max">
    <div class="shadow border-b border-gray-200 sm:rounded-lg">
      <table class="bg-white sm:rounded-lg min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              scope="col"
              class="
                px-6
                py-3
                text-left text-xs
                font-medium
                text-gray-500
                uppercase
                tracking-wider
              "
            >
              Name
            </th>
            <th
              scope="col"
              class="
                px-6
                py-3
                text-left text-xs
                font-medium
                text-gray-500
                uppercase
                tracking-wider
              "
            >
              Next Size
            </th>
            <th
              scope="col"
              class="
                px-6
                py-3
                text-left text-xs
                font-medium
                text-gray-500
                uppercase
                tracking-wider
              "
            >
              Delete
            </th>
            <th
              scope="col"
              class="
                px-4
                py-3
                text-left text-xs
                font-medium
                text-gray-500
                uppercase
                tracking-wider
              "
            >
              Sort
            </th>
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
              <td
                class="
                  handle
                  px-4
                  py-4
                  whitespace-nowrap
                  text-sm text-center
                  font-medium
                  text-gray-700
                "
              >
                <delete-size-component :size="element" />
              </td>
              <td
                class="
                  cursor-pointer
                  handle
                  px-4
                  py-4
                  whitespace-nowrap
                  text-sm
                  font-medium
                  text-gray-700
                "
              >
                <svg
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
                  ></path>
                </svg>
              </td>
            </tr>
          </template>
        </draggable>
      </table>
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
export default {
  components: { EmptyState, UpdateSizeForm, draggable, DeleteSizeComponent },
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
