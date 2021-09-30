<template>
  <form
    @submit.prevent="searchInventory"
    class="flex items-center space-x-2 max-w-lg"
  >
    <SearchInput
      v-model="id"
      class="mt-0 w-full"
      ref="search"
      :disabled="loading"
      placeholder="Search by plant id"
      title="Must be a valid id"
      inputmode="numeric"
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
      loading: false,
    };
  },

  methods: {
    searchInventory() {
      Inertia.get(route("inventory.show", this.id));
    },
    focusSearchBar() {
      const searchBar = document.getElementById("search");
      if (searchBar) {
        searchBar.focus();
      }
    },
    updateLoadingState() {
      Inertia.on("start", () => {
        this.loading = true;
      });
      Inertia.on("finish", (event) => {
        this.loading = false;
        this.$nextTick(() => {
          this.focusSearchBar();
        });
      });
    },
  },
  mounted() {
    this.updateLoadingState();
  },
};
</script>
