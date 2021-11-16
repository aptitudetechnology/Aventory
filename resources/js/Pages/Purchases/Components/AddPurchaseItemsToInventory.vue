<template>
    <div>
        <jet-button @click="addingInventory = true"
            >Add Selected to Inventory</jet-button
        >
        <jet-dialog-modal
            :show="addingInventory"
            @close="addingInventory = false"
        >
            <template #title>Add these items to inventory.</template>

            <template #description>
                Once you add these items to inventory, you can print their tags.
                You won't be able to make changes to these items once added to
                inventory unless you remove them from inventory.
            </template>

            <template #content>
                <form
                    @submit.prevent="addInventory"
                    @keydown.enter="addInventory"
                >
                    <div class="col-span-6 grid gap-6 divide-gray-100 divide-y">
                        <div>
                            <h2
                                class="
                                    text-lg
                                    leading-6
                                    font-medium
                                    text-gray-900
                                "
                            >
                                Inventory Type
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Choose how these items will be stored in
                                inventory. Within a group, or individually.
                            </p>
                            <RadioGroup v-model="selectedType" class="mt-4">
                                <RadioGroupLabel class="sr-only">
                                    Type of inventory
                                </RadioGroupLabel>
                                <JetInputError :message="form.errors.type" />
                                <div class="bg-white rounded-md -space-y-px">
                                    <RadioGroupOption
                                        as="template"
                                        v-for="(type, typeIdx) in types"
                                        :key="type.name"
                                        :value="type"
                                        v-slot="{ checked, active }"
                                    >
                                        <div
                                            :class="[
                                                typeIdx === 0
                                                    ? 'rounded-tl-md rounded-tr-md'
                                                    : '',
                                                typeIdx === types.length - 1
                                                    ? 'rounded-bl-md rounded-br-md'
                                                    : '',
                                                checked
                                                    ? 'bg-green-50 border-green-200 z-10'
                                                    : 'border-gray-200',
                                                'relative border p-4 flex cursor-pointer focus:outline-none',
                                            ]"
                                        >
                                            <span
                                                :class="[
                                                    checked
                                                        ? 'bg-green-600 border-transparent'
                                                        : 'bg-white border-gray-300',
                                                    active
                                                        ? 'ring-2 ring-offset-2 ring-green-500'
                                                        : '',
                                                    'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center flex-shrink-0',
                                                ]"
                                                aria-hidden="true"
                                            >
                                                <span
                                                    class="
                                                        rounded-full
                                                        bg-white
                                                        w-1.5
                                                        h-1.5
                                                    "
                                                />
                                            </span>
                                            <div class="ml-3 flex flex-col">
                                                <RadioGroupLabel
                                                    as="span"
                                                    :class="[
                                                        checked
                                                            ? 'text-green-900'
                                                            : 'text-gray-900',
                                                        'block text-sm font-medium',
                                                    ]"
                                                >
                                                    {{ type.name }}
                                                </RadioGroupLabel>
                                                <RadioGroupDescription
                                                    as="span"
                                                    :class="[
                                                        checked
                                                            ? 'text-green-700'
                                                            : 'text-gray-500',
                                                        'block text-sm',
                                                    ]"
                                                >
                                                    {{ type.description }}
                                                </RadioGroupDescription>
                                            </div>
                                        </div>
                                    </RadioGroupOption>
                                </div>
                            </RadioGroup>
                        </div>

                        <div v-if="!selectedNursery" class="pt-6">
                            <h2
                                class="
                                    text-lg
                                    leading-6
                                    font-medium
                                    text-gray-900
                                "
                            >
                                Nursery Location
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Select which nursery these plants will be
                                located in.
                            </p>
                            <RadioGroup v-model="selectedNursery" class="mt-4">
                                <RadioGroupLabel class="sr-only">
                                    Nursery Location
                                </RadioGroupLabel>
                                <JetInputError
                                    :message="form.errors.nursery_location_id"
                                />
                                <div class="bg-white rounded-md -space-y-px">
                                    <RadioGroupOption
                                        as="template"
                                        v-for="(nursery, typeIdx) in nurseries"
                                        :key="nursery.id"
                                        :value="nursery"
                                        v-slot="{ checked, active }"
                                    >
                                        <div
                                            :class="[
                                                typeIdx === 0
                                                    ? 'rounded-tl-md rounded-tr-md'
                                                    : '',
                                                typeIdx === nurseries.length - 1
                                                    ? 'rounded-bl-md rounded-br-md'
                                                    : '',
                                                checked
                                                    ? 'bg-green-50 border-green-200 z-10'
                                                    : 'border-gray-200',
                                                'relative border p-4 flex cursor-pointer focus:outline-none',
                                            ]"
                                        >
                                            <span
                                                :class="[
                                                    checked
                                                        ? 'bg-green-600 border-transparent'
                                                        : 'bg-white border-gray-300',
                                                    active
                                                        ? 'ring-2 ring-offset-2 ring-green-500'
                                                        : '',
                                                    'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center flex-shrink-0',
                                                ]"
                                                aria-hidden="true"
                                            >
                                                <span
                                                    class="
                                                        rounded-full
                                                        bg-white
                                                        w-1.5
                                                        h-1.5
                                                    "
                                                />
                                            </span>
                                            <div class="ml-3 flex flex-col">
                                                <RadioGroupLabel
                                                    as="span"
                                                    :class="[
                                                        checked
                                                            ? 'text-green-900'
                                                            : 'text-gray-900',
                                                        'block text-sm font-medium',
                                                    ]"
                                                >
                                                    {{ nursery.name }}
                                                </RadioGroupLabel>
                                                <RadioGroupDescription
                                                    as="span"
                                                    :class="[
                                                        checked
                                                            ? 'text-green-700'
                                                            : 'text-gray-500',
                                                        'block text-sm',
                                                    ]"
                                                >
                                                    {{ nursery.city
                                                    }}{{ ", " + nursery.state }}
                                                </RadioGroupDescription>
                                            </div>
                                        </div>
                                    </RadioGroupOption>
                                </div>
                            </RadioGroup>
                        </div>
                        <div v-if="selectedNursery" class="py-4">
                            <back-button
                                @click="selectedNursery = null"
                                class="mb-4"
                                >Change Nursery</back-button
                            >
                            <h2
                                class="
                                    text-lg
                                    leading-6
                                    font-medium
                                    text-gray-900
                                "
                            >
                                {{ selectedNursery.name }}: Block Location
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Here you can add a block location for these
                                items. This will give group inventory their
                                location, and individual inventory a block
                                location until they are given a place.
                            </p>
                            <select-box
                                :items="blocks"
                                :showLabel="false"
                                v-model="selectedBlock"
                                class="mt-4"
                            />
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <div class="flex justify-between w-full">
                    <jet-secondary-button
                        type="button"
                        @click="addingInventory = false"
                        >Cancel</jet-secondary-button
                    >
                    <div>
                        <jet-button
                            type="submit"
                            @click="addInventory"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            >Add items to Inventory</jet-button
                        >
                    </div>
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";

import JetButton from "@/Jetstream/Button";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

import BackButton from "@/Components/Buttons/BackButton.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import { Inertia } from "@inertiajs/inertia";

const types = [
    {
        name: "Individual",
        value: "individual",
        description:
            "Store these items individually in inventory. Each item will have a unique tag id, and a unique place in the nursery.",
    },
    {
        name: "Group",
        value: "group",
        description:
            "Store items in a group. Items will be sized and given a block location as a whole. Each item will have an matching id tag.",
    },
];

export default {
    components: {
        RadioGroup,
        RadioGroupDescription,
        RadioGroupLabel,
        RadioGroupOption,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        SelectBox,
        BackButton,
    },
    props: { selectedItems: Array },

    data() {
        return {
            blocks: [],
            nurseries: this.$page.props.nurseryLocations,
            selectedBlock: null,
            selectedNursery: null,
            addingInventory: false,
            types: types,
            selectedType: null,
            form: this.$inertia.form({
                _method: "POST",
                type: null,
                block_id: null,
                nursery_location_id: null,
                selectedItems: this.selectedItems,
            }),
        };
    },
    watch: {
        selectedType(type) {
            this.form.type = type.value;
        },
        selectedBlock(block) {
            if (block) {
                this.form.block_id = block.id;
            } else {
                this.form.block_id = null;
            }
        },
        selectedNursery(nursery) {
            if (nursery) {
                this.form.nursery_location_id = nursery.id;
                this.blocks = this.$page.props.blocks.filter(
                    (block) => block.nursery_location_id === nursery.id
                );
            } else {
                this.form.nursery_location_id = null;
            }
        },
    },

    methods: {
        addInventory() {
            this.form.post(route("inventory.store"), {
                preserveState: true,

                onSuccess: () => {
                    Inertia.reload();
                },
            });
        },
    },
};
</script>
