<template>
  <div class="py-4 grid gap-4">
    <div class="flex flex-wrap items-center justify-between">
      <h2 class="text-xl">Inventory Location</h2>
      <jet-button class="ml-auto pl-2"
        ><EditIcon class="w-4 h-4 mr-2"></EditIcon> Edit</jet-button
      >
    </div>

    <p v-if="inventory.block">Block: {{ inventory.block.name }}</p>
    <p>Place:</p>
    <p v-if="inventory.place">
      {{ inventory.place.row_number }}
    </p>
    <p v-else>Unasigned</p>
  </div>
</template>
<script>
import EditIcon from "@heroicons/vue/outline/PencilIcon";
import JetButton from "@/Jetstream/Button.vue";
export default {
  components: {
    EditIcon,
    JetButton,
  },
  props: {
    inventory: Object,
  },
};
</script>