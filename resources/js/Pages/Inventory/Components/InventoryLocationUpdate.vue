<template>
    <div class="py-4 grid gap-4">
        <div class="flex flex-wrap items-center justify-between">
            <h2 class="text-xl">Inventory Location</h2>
            <jet-button
                @click="editingInventoryLocation = true"
                class="ml-auto pl-2"
                ><PencilIcon class="w-4 h-4 mr-2"></PencilIcon> Edit</jet-button
            >
        </div>

        <p v-if="inventory.block">Block: {{ inventory.block.name }}</p>
        <p v-else class="text-red-500">Location Unasigned!</p>
        <p
            v-if="
                inventory.block &&
                inventory.block.has_places &&
                !inventory.place &&
                inventory.type != 'group'
            "
            class="text-red-500"
        >
            Place Unasigned!
        </p>
        <div v-if="inventory.type != 'group'">
            <div v-if="inventory.block && inventory.place" class="grid gap-4">
                <p>
                    Place: Row number: {{ inventory.place.row_number }} Plant
                    Number:
                    {{ inventory.place.plant_number }}
                </p>
                <div
                    v-if="inventory.block && inventory.place"
                    class="flex items-center justify-between space-x-2 w-full"
                >
                    <jet-button
                        :disabled="!locationData.previousPlace"
                        @click="assignNextPlace(locationData.previousPlace)"
                        class="flex-shrink-0 pl-2"
                        ><ChevronLeftIcon class="w-4 h-4 mr-2" />
                        Previous</jet-button
                    >
                    <jet-button
                        :disabled="!locationData.nextPlace"
                        @click="assignNextPlace(locationData.nextPlace)"
                        class="flex-shrink-0 pr-2"
                        >Next<ChevronRightIcon class="w-4 h-4 ml-2"
                    /></jet-button>
                </div>
                <jet-label class="text-lg">
                    {{ autolocateLabel }}
                    <jet-checkbox
                        :checked="locationData.autoLocate"
                        v-model="locationData.autoLocate"
                        class="ml-2"
                    />
                </jet-label>
                <div
                    v-if="locationData.autoLocate"
                    class="flex space-between-4 items-center"
                >
                    <jet-label
                        >Autolocate to previous
                        <input
                            type="radio"
                            v-bind:value="false"
                            v-model="locationData.autoLocateToNext"
                            class="ml-2 border-gray-300 shadow-sm focus:border-none focus:ring-1 focus:ring-current focus:ring-opacity-50 cursor-pointer text-green-600"
                        />
                    </jet-label>
                    <jet-label
                        >Autolocate to next
                        <input
                            type="radio"
                            v-bind:value="true"
                            v-model="locationData.autoLocateToNext"
                            class="ml-2 border-gray-300 shadow-sm focus:border-none focus:ring-1 focus:ring-current focus:ring-opacity-50 cursor-pointer text-green-600"
                        />
                    </jet-label>
                </div>
            </div>
        </div>

        <jet-confirmation-modal :show="confirmingReplace" @close="dontConfirm">
            <template #title
                >There is another item in this place. Are you sure you want to
                replace that item?</template
            >
            <template #content
                >The inventory item located in this place will be given an
                unnasigned location.</template
            >
            <template #footer
                ><div class="flex justify-between items-center w-full">
                    <jet-secondary-button @click="dontConfirm"
                        >No, Nevermind</jet-secondary-button
                    >
                    <jet-button
                        @click="confirm"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        >Yes, I'm sure</jet-button
                    >
                </div></template
            >
        </jet-confirmation-modal>
        <jet-dialog-modal
            :show="editingInventoryLocation"
            @close="editingInventoryLocation = false"
        >
            <template #title>Edit Inventory Location</template>

            <template #description> Update this inventory location.</template>

            <template #content>
                <form
                    @submit.prevent="updateInventoryLocation"
                    @keydown.enter="updateInventoryLocation"
                >
                    <div class="col-span-6 grid gap-4">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <select-box
                                    labelValue="Block Location"
                                    :items="blocks"
                                    :selectedItem="selectedBlock"
                                    v-model="selectedBlock"
                                />
                                <jet-input-error
                                    v-if="!form.block_id"
                                    :message="form.errors.block_id"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                        <div
                            v-if="
                                selectedBlock?.has_places &&
                                inventory.type != 'group'
                            "
                        >
                            <div
                                v-if="!loading"
                                class="grid gap-4 sm:grid-cols-2"
                            >
                                <div class="sm:col-span-1">
                                    <select-box
                                        labelValue="Row Number"
                                        :items="rows"
                                        :selectedItem="row"
                                        v-model="row"
                                    />
                                    <jet-input-error
                                        v-if="!form.block_id"
                                        :message="form.errors.block_id"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="sm:col-span-1">
                                    <select-box
                                        labelValue="Plant Number"
                                        :items="rowPlantNumbers"
                                        :selectedItem="place"
                                        v-model="place"
                                        nameValue="plant_number"
                                    />
                                    <jet-input-error
                                        v-if="!form.block_id"
                                        :message="form.errors.block_id"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                            <div v-else class="text-sm">Loading Places...</div>
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <div class="flex justify-between items-center w-full">
                    <jet-secondary-button
                        type="button"
                        @click="editingInventoryLocation = false"
                        >Cancel</jet-secondary-button
                    >
                    <div>
                        <jet-button
                            type="submit"
                            @click="updateInventoryLocation"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            >Save Location</jet-button
                        >
                    </div>
                </div>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import {
    PencilIcon,
    ChevronLeftIcon,
    ChevronRightIcon,
} from "@heroicons/vue/20/solid";
import JetButton from "@/Jetstream/Button.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
export default {
    components: {
        ChevronLeftIcon,
        ChevronRightIcon,
        JetDialogModal,
        JetConfirmationModal,
        PencilIcon,
        JetInputError,
        JetLabel,
        JetCheckbox,
        JetButton,
        JetSecondaryButton,
        SelectBox,
    },
    props: {
        inventory: Object,
    },
    data() {
        return {
            loading: false,
            locationData: {
                nextPlace: null,
                previousPlace: null,
                autoLocate: true,
                autoLocateToNext: true,
            },
            autoLocateNotice: {
                wasAutoLocated: true,
                message: null,
            },
            confirmingReplace: false,
            editingInventoryLocation: false,
            selectedBlock: this.inventory.block,
            blocks: this.$page.props.blocks,
            row: this.inventory.place
                ? { name: this.inventory.place.row_number }
                : null,
            place: this.inventory.place,
            places: [],
            form: this.$inertia.form({
                block_id: this.inventory.block_id,
                place_id: this.inventory.place_id,
                confirm_replace: null,
            }),
        };
    },
    watch: {
        locationData: {
            handler(value) {
                localStorage.setItem("locationData", JSON.stringify(value));
            },
            deep: true,
        },
        selectedBlock(block) {
            if (block) {
                this.form.block_id = block.id;
                this.row = null;
                this.getPlaces(block);
            } else {
                this.form.block_id = null;
            }
        },
        row(row) {
            if (this.place?.row_number != row?.name) {
                this.place = null;
            }
        },
        place(place) {
            if (place) {
                this.form.place_id = place.id;
                this.row = { name: place.row_number };
                this.updateNextandPrevious();
            } else {
                this.form.place_id = null;
            }
        },
    },
    mounted() {
        if (localStorage.getItem("locationData")) {
            try {
                this.locationData = JSON.parse(
                    localStorage.getItem("locationData")
                );
            } catch (e) {
                localStorage.removeItem("locationData");
            }
        }
        if (this.inventory.type == "group") {
            this.locationData.autoLocate = false;
        }
        if (
            this.locationData.autoLocate &&
            this.inventory.id != localStorage.lastInventoryId
        ) {
            const data = this.locationData;
            if (data.autoLocateToNext) {
                if (data.nextPlace) {
                    this.assignBlock(data.nextPlace);
                    this.$nextTick(() => {
                        new Promise((resolve) => {
                            setTimeout(() => {
                                this.assignNextPlace(data.nextPlace);
                                resolve();
                            }, 50);
                        }).then(() => {
                            this.makeAutoLocateNotice(
                                true,
                                `Autolocated to next place: row# ${this.place.row_number}, plant# ${this.place.plant_number}`
                            );
                        });
                    });
                } else {
                    this.makeAutoLocateNotice(
                        false,
                        "Was not autolocated. No more places in current row."
                    );
                    // make user set auto locate again if reached last place
                    this.locationData.autoLocate = false;
                }
            } else if (data.previousPlace) {
                this.assignBlock(data.previousPlace);
                this.$nextTick(() => {
                    new Promise((resolve) => {
                        setTimeout(() => {
                            this.assignNextPlace(data.previousPlace);
                            resolve();
                        }, 50);
                    }).then(() => {
                        this.makeAutoLocateNotice(
                            true,
                            `Autolocated to previous place: Row# ${this.place.row_number}, Plant# ${this.place.plant_number}`
                        );
                    });
                });
            } else {
                this.makeAutoLocateNotice(
                    false,
                    "Was not autolocated. Reached first place in current row."
                );
                // make user set auto locate again if reached first place
                this.locationData.autoLocate = false;
            }
        }
        if (this.selectedBlock?.has_places) {
            this.getPlaces(this.selectedBlock);
        }
    },
    emits: ["autolocated"],

    computed: {
        rows() {
            return [
                ...new Set(this.places.map((place) => place.row_number)),
            ].map((row) => {
                let obj = {};
                obj.name = row;
                return obj;
            });
        },
        rowPlantNumbers() {
            if (this.places.length && this.row) {
                return this.places.filter(
                    (place) => place.row_number == this.row.name
                );
            }
        },
        autolocateLabel() {
            if (this.locationData.autoLocate) {
                if (this.locationData.autoLocateToNext) {
                    return this.locationData.nextPlace
                        ? `Autolocate to Row: ${this.locationData.nextPlace.row_number}, Plant: ${this.locationData.nextPlace.plant_number}`
                        : "Reached last place in row.";
                } else {
                    return this.locationData.previousPlace
                        ? `Autolocate to Row: ${this.locationData.previousPlace.row_number}, Plant: ${this.locationData.previousPlace.plant_number}`
                        : "Reached first place in row.";
                }
            }
            return "Autolocate?";
        },
    },

    methods: {
        updateNextandPrevious() {
            if (this.place) {
                this.locationData.previousPlace = this.places.filter(
                    (place) => {
                        return (
                            place.plant_number ===
                                this.place.plant_number - 1 &&
                            place.row_number === this.place.row_number
                        );
                    }
                )[0];

                this.locationData.nextPlace = this.places.filter((place) => {
                    return (
                        place.plant_number === this.place.plant_number + 1 &&
                        place.row_number === this.place.row_number
                    );
                })[0];
            }
        },
        assignNextPlace(location) {
            if (location) {
                this.place = location;
            }
            this.$nextTick(() => {
                this.updateInventoryLocation();
            });
            this.autoLocateNotice.message = null;
            this.$emit("autolocated", this.autoLocateNotice);
        },
        assignBlock(place) {
            this.selectedBlock = this.blocks.find(
                (block) => (block.id = place.block_id)
            );
        },
        makeAutoLocateNotice(wasAutoLocated, message) {
            this.autoLocateNotice = {
                wasAutoLocated: wasAutoLocated,
                message: message,
            };
            this.$emit("autolocated", this.autoLocateNotice);
        },
        confirm() {
            this.form.confirm_replace = true;
            this.confirmingReplace = false;
            this.form.clearErrors();
            this.updateInventoryLocation();
        },
        dontConfirm() {
            this.autoLocateNotice.message = null;
            this.confirmingReplace = false;
            this.form.clearErrors();
            this.$inertia.reload();
        },
        updateInventoryLocation() {
            this.form.patch(route("inventory.update", this.inventory), {
                onSuccess: (page) => {
                    this.editingInventoryLocation = false;
                    this.form.confirm_replace = null;
                },
                onError: (errors) => {
                    if (errors.confirm_replace) {
                        this.editingInventoryLocation = false;
                        this.confirmingReplace = true;
                    }
                },
            });
        },
        getPlaces(block) {
            this.loading = true;
            axios
                .get(route("api.places.index", block), {
                    Headers: { "Cache-Control": "cache" },
                })

                .then((res) => {
                    this.places = res.data;
                    this.loading = false;
                    this.updateNextandPrevious();
                })

                .catch((error) => {
                    console.error(error.message);
                });
        },
    },
};
</script>
