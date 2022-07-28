<template>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <jet-label class="sr-only" for="name" value="Size Name" />
        <jet-input
            @change="updateSize"
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            required
            autocomplete="off"
        />
        <jet-input-error :message="form.errors.name" class="mt-2" />
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        <select-box
            :items="sizes"
            :showLabel="false"
            :selectedItem="selectedSize"
            v-model="selectedSize"
        />
    </td>
</template>
<script>
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";

import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";

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
    props: {
        size: Object,
    },
    data() {
        return {
            sizes: this.$page.props.sizes,
            selectedSize: this.$page.props.sizes.find(
                (size) => size.id == this.size.next_size_id
            ),
            form: this.$inertia.form({
                _method: "POST",
                name: this.size.name,
                next_size_id: this.size.next_size_id,
            }),
        };
    },
    watch: {
        selectedSize(value) {
            this.form.next_size_id = value.id;
            this.updateSize();
        },
    },

    methods: {
        updateSize() {
            this.form.patch(route("sizes.update", this.size), {
                errorBag: "updateSize",
                preserveScroll: true,
            });
        },
    },
};
</script>
