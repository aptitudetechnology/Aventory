<template>
    <div class="dropdown dropdown-hover dropdown-end">
        <ActionButton class="bg-white">Actions</ActionButton>
        <ul
            tabindex="0"
            class="shadow menu dropdown-content bg-base-100 rounded-lg text-right w-52"
        >
            <li v-if="!order.is_quote || order.status == 'Pending'">
                <a @click="convert" class="justify-end px-4 capitalize">{{
                    convertText
                }}</a>
            </li>
            <li v-if="order.is_quote">
                <a @click="showCustomConvert" class="justify-end px-4"
                    >New Order from Quote</a
                >
            </li>
        </ul>
    </div>
    <dialog-modal :show="customConvert" @close="customConvert = false">
        <template #title> Select order items to convert to order. </template>
        <template #content>
            <div>
                <ErrorMessage
                    :title="errorMessage"
                    :message="errorMessage"
                    v-if="errorMessage"
                />
                <div
                    v-for="item in availableItems"
                    :key="item.id"
                    class="flex items-center py-2"
                >
                    <span>{{ item.size_name }} {{ item.product_name }} </span>
                    <form
                        @submit.prevent="addOrRemoveItem(item)"
                        class="ml-auto flex items-center"
                    >
                        <label class="input-group input-group-sm">
                            <span class="label-text">Qty</span>
                            <input
                                :disabled="isAdded(item)"
                                type="number"
                                min="0"
                                v-model="item.quantity"
                                class="input input-bordered input-sm w-20"
                            />
                        </label>

                        <jet-button
                            type="submit"
                            class="ml-2 btn-sm"
                            :class="isAdded(item) ? 'btn-error' : ''"
                        >
                            <span v-if="isAdded(item)">Remove</span>
                            <span v-else>Add</span>
                        </jet-button>
                    </form>
                </div>
            </div>
        </template>

        <template #footer
            ><jet-button @click="convert">Create Order</jet-button></template
        >
    </dialog-modal>
</template>
<script>
import ActionButton from "@/Components/Buttons/ActionButton.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import ErrorMessage from "@/Components/ErrorMessage.vue";
export default {
    components: {
        ActionButton,
        DialogModal,
        ErrorMessage,
    },
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            customConvert: false,
            items: [],
            errorMessage: "",
            availableItems: this.order.items,
        };
    },
    computed: {
        convertText() {
            return this.order.is_quote
                ? "Convert to Order"
                : "Convert to Quote";
        },
    },

    methods: {
        convert() {
            if (this.customConvert && !this.items.length) {
                this.errorMessage = "Please select items to convert.";
                return;
            }

            this.$inertia.post(route("sales.convert", this.order.id), {
                items: this.items,
            });
        },
        showCustomConvert() {
            this.customConvert = true;
        },
        addOrRemoveItem(item) {
            if (this.isAdded(item)) {
                this.items = this.items.filter(
                    (oldItem) => oldItem.id !== item.id
                );
            } else {
                this.items.push(item);
            }
        },
        isAdded(item) {
            return this.items.find((i) => i.id === item.id);
        },
    },
};
</script>
