<template>
  <div class="grid gap-4">
    <select-box :items="categories" v-model="category" labelValue="Category" />
  </div>
</template>
<script>
import SelectBox from "@/Components/SelectBox";
export default {
  components: {
    SelectBox,
  },
  data() {
    return {
      categories: [],
      category: null,
    };
  },
  mounted() {
    axios.get(route("api.categories")).then((response) => {
      this.categories = response.data;
    });
  },
};
</script>
