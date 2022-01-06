<template>
    <div>
        <jet-form-section @submitted="updateProduct">
            <template #title>{{ product.name }}</template>

            <template #description>
                View and make changes to this product.
            </template>

            <template #form>
                <div class="col-span-6">
                    <div class="grid gap-4" v-if="product.type != 'plant'">
                        <div class="col-span-3">
                            <jet-label for="name" value="Product Name" />
                            <jet-input
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autocomplete="off"
                            />
                            <jet-input-error
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>
                        <div class="col-span-3">
                            <select-box
                                :items="categories"
                                v-model="selectedCategory"
                                :selectedItem="selectedCategory"
                                labelValue="Category"
                            />
                            <jet-input-error
                                :message="form.errors.category_id"
                                class="mt-2"
                            />
                        </div>
                        <div class="col-span-3">
                            <jet-label for="description" value="Description" />
                            <text-area-input
                                id="description"
                                class="mt-1 block w-full"
                                v-model="form.description"
                            />
                            <jet-input-error
                                :message="form.errors.description"
                                class="mt-2"
                            />
                        </div>
                    </div>
                    <div v-else>
                        <div class="grid gap-4">
                            <div class="col-span-3">
                                <jet-label
                                    for="scientific_name"
                                    value="Scientific Name"
                                />
                                <jet-input
                                    id="scientific_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.scientific_name"
                                    required
                                    autocomplete="off"
                                />
                                <jet-input-error
                                    :message="form.errors.scientific_name"
                                    class="mt-2"
                                />
                            </div>
                            <div class="col-span-3">
                                <jet-label
                                    for="common_name"
                                    value="Common Name"
                                />
                                <jet-input
                                    id="common_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.common_name"
                                    required
                                    autocomplete="off"
                                />
                                <jet-input-error
                                    :message="form.errors.common_name"
                                    class="mt-2"
                                />
                            </div>
                            <div class="col-span-3">
                                <select-box
                                    :items="categories"
                                    v-model="selectedCategory"
                                    :selectedItem="selectedCategory"
                                    labelValue="Category"
                                />
                                <jet-input-error
                                    :message="form.errors.category_id"
                                    class="mt-2"
                                />
                            </div>
                            <div class="col-span-3">
                                <jet-label
                                    for="description"
                                    value="Description"
                                />
                                <text-area-input
                                    id="description"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                />
                                <jet-input-error
                                    :message="form.errors.description"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                        <div class="grid gap-4">
                            <div class="col-span-3 pt-6">
                                <h3
                                    class="
                                        text-lg
                                        leading-6
                                        font-medium
                                        text-gray-900
                                    "
                                >
                                    Plant details
                                </h3>
                            </div>

                            <div class="grid gap-4 col-span-3 grid-cols-3">
                                <div class="col-span-3 sm:col-span-1">
                                    <jet-label for="zone"
                                        >Growing Zone</jet-label
                                    >
                                    <jet-input
                                        id="zone"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.zone"
                                        autocomplete="off"
                                    />
                                    <jet-input-error
                                        :message="form.errors.zone"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-3 sm:col-span-1">
                                    <jet-label for="height"
                                        >Mature Height</jet-label
                                    >
                                    <jet-input
                                        id="height"
                                        type="number"
                                        min="0"
                                        class="mt-1 block w-full"
                                        v-model="form.height"
                                        autocomplete="off"
                                    />
                                    <jet-input-error
                                        :message="form.errors.height"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-3 sm:col-span-1">
                                    <jet-label for="spread"
                                        >Mature Spread</jet-label
                                    >
                                    <jet-input
                                        id="spread"
                                        type="number"
                                        min="0"
                                        class="mt-1 block w-full"
                                        v-model="form.spread"
                                        autocomplete="off"
                                    />
                                    <jet-input-error
                                        :message="form.errors.spread"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-3 sm:col-span-1">
                                    <jet-label for="bloom_color"
                                        >Bloom Color</jet-label
                                    >
                                    <jet-input
                                        id="bloom_color"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.bloom_color"
                                        autocomplete="off"
                                    />
                                    <jet-input-error
                                        :message="form.errors.bloom_color"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-3 sm:col-span-1">
                                    <jet-label for="fall_color"
                                        >Fall Color</jet-label
                                    >
                                    <jet-input
                                        id="fall_color"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.fall_color"
                                        autocomplete="off"
                                    />
                                    <jet-input-error
                                        :message="form.errors.fall_color"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-3 sm:col-span-1">
                                    <jet-label for="growth_rate"
                                        >Growth Rate</jet-label
                                    >
                                    <jet-input
                                        id="growth_rate"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.growth_rate"
                                        autocomplete="off"
                                    />
                                    <jet-input-error
                                        :message="form.errors.growth_rate"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template #actions>
                <jet-button
                    type="submit"
                    :class="{ 'opacity-25': form.processing || !form.isDirty }"
                    :disabled="form.processing || !form.isDirty"
                    >Save Product</jet-button
                >
            </template>
        </jet-form-section>
    </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";

import SelectBox from "@/Components/Forms/SelectBox.vue";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        TextAreaInput,
        SelectBox,
    },
    props: { product: Object },
    data() {
        return {
            selectedCategory: this.product.category,
            categories: this.$page.props.categories,
            form: this.$inertia.form({
                _method: "PATCH",
                name: this.product.name,
                description: this.product.description,
                category_id: this.product.category_id,
                type: this.product.type,

                // Plant attributes
                scientific_name: this.product.plant
                    ? this.product.plant.scientific_name
                    : null,
                common_name: this.product.plant
                    ? this.product.plant.common_name
                    : null,
                zone: this.product.plant ? this.product.plant.zone : null,
                height: this.product.plant ? this.product.plant.height : null,
                spread: this.product.plant ? this.product.plant.spread : null,
                bloom_color: this.product.plant
                    ? this.product.plant.bloom_color
                    : null,
                fall_color: this.product.plant
                    ? this.product.plant.fall_color
                    : null,
                growth_rate: this.product.plant
                    ? this.product.plant.growth_rate
                    : null,
            }),
        };
    },
    watch: {
        selectedCategory() {
            this.form.category_id = this.selectedCategory.id;
        },
        name() {
            this.form.name = this.name;
        },
    },
    computed: {
        name() {
            if (this.form.type == "plant" && this.form.scientific_name) {
                return (
                    this.form.scientific_name + " / " + this.form.common_name
                );
            } else {
                return this.form.name;
            }
        },
    },
    methods: {
        updateProduct() {
            this.form.patch(route("products.update", this.product), {
                errorBag: "updateProduct",
                preserveScroll: true,
            });
        },
    },
};
</script>
