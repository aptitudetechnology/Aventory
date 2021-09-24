<template>
  <form
    @submit.prevent="searchInventory"
    class="flex items-center space-x-2 max-w-lg"
  >
    <SearchInput
      v-model="id"
      class="mt-0 w-full"
      placeholder="Search by plant id"
    />
    <jet-button type="submit" :disabled="!id">Search</jet-button>
  </form>
</template>


<script>
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
      form: this.$inertia.form({}),
    };
  },

  methods: {
    searchInventory() {
      this.form.get(route("inventory.show", this.id), {
        errorBag: "searchInventory",
        preserveScroll: true,
      });
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
