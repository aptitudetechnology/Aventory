<template>
    <div class="grid gap-4 col-span-3">
        <select-box
            :items="categories"
            v-model="selectedCategory"
            labelValue="Category"
        />
    </div>
</template>
<script>
import SelectBox from "@/Components/Forms/SelectBox.vue";
export default {
    components: {
        SelectBox,
    },
    props: {
        category: Object,
    },
    data() {
        return {
            categories: [],
            selectedCategory: this.category,
        };
    },
    mounted() {
        axios.get(route("api.categories")).then((response) => {
            this.categories = response.data;
        });
    },
};
</script>
