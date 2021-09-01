
<template>
  <div v-if="sizes.length > 0" class="flex flex-col max-w-screen-sm">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
        >
          <table class="min-w-full divide-y divide-gray-200">
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
              </tr>
            </thead>
            <draggable
              tag="tbody"
              v-model="sizes"
              item-key="id"
              class="bg-white divide-y divide-gray-200"
            >
              <template #item="{ element }">
                <tr>
                  <update-size-form :size="element" />
                </tr>
              </template>
            </draggable>
          </table>
        </div>
      </div>
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
export default {
  components: { EmptyState, UpdateSizeForm, draggable },
  data() {
    return {
      sizes: this.$page.props.sizes,
      drag: false,
    };
  },
};
</script>
