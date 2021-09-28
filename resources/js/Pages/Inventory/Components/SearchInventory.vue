<template>
  <form
    @submit.prevent="searchInventory"
    class="flex items-center space-x-2 max-w-lg"
  >
    <SearchInput
      v-model="id"
      class="mt-0 w-full"
      placeholder="Search by plant id"
      title="Must be a valid id"
      pattern="\d*"
    />
    <jet-button type="submit" :disabled="!id">Search</jet-button>
  </form>
</template>


<script>
import { Inertia } from "@inertiajs/inertia";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import SearchInput from "@Components/SearchInput.vue";
export default {
  components: {
    JetButton,
    JetInput,
    JetInputError,
    JetLabel,

    SearchInput,
  },

  data() {
    return {
      id: "",
    };
  },

  methods: {
    searchInventory() {
      Inertia.get(route("inventory.show", this.id));
    },
  },
  mounted() {
    const searchBar = document.getElementById("search");
    if (searchBar) {
      searchBar.focus();
    }
  },
};
</script>
