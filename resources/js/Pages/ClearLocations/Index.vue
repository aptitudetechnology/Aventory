<template>
    <app-layout>
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <main-area :dontShowOnMobile="false">
                <InventoryTabs />
                <Card class="w-full max-w-screen-sm">
                    <section-title>
                        <template #title>Select a Nursery Location</template>
                    </section-title>
                    <div class="space-y-4">
                        <select-box
                            labelValue="Select Nursery"
                            :items="nurseries"
                            v-model="selectedNursery"
                        ></select-box>

                        <select-box
                            v-if="selectedNursery"
                            labelValue="Select Block"
                            :items="blocks"
                            v-model="selectedBlock"
                        />

                        <form
                            v-if="selectedBlock && selectedNursery"
                            @submit.prevent="clearLocations"
                        >
                            <div class="grid gap-4 grid-cols-2">
                                <div>
                                    <jet-label for="starting"
                                        >Starting Row to Clear</jet-label
                                    >
                                    <jet-input
                                        id="starting"
                                        type="number"
                                        class="w-full"
                                        :min="firstRowInBlock"
                                        :max="lastRowInBlock"
                                        v-model="form.starting_row"
                                    ></jet-input>
                                </div>
                                <div>
                                    <jet-label for="ending"
                                        >Ending Row to Clear</jet-label
                                    >
                                    <jet-input
                                        id="ending"
                                        type="number"
                                        class="w-full"
                                        :min="
                                            form.starting_row
                                                ? form.starting_row
                                                : firstRowInBlock
                                        "
                                        :max="lastRowInBlock"
                                        v-model="form.ending_row"
                                    ></jet-input>
                                </div>
                            </div>
                            <jet-button type="submit" class="mt-4"
                                >Clear Locations</jet-button
                            >
                        </form>
                    </div>
                </Card>
            </main-area>
        </div>
    </app-layout>
</template>

<script>
import SectionTitle from "@/Jetstream/SectionTitle.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import MainArea from "@/Components/MainArea.vue";
import InventoryTabs from "@/Components/InventoryTabs.vue";
import Card from "@/Components/Card.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
export default {
    components: {
        SectionTitle,
        JetInput,
        JetLabel,
        JetButton,
        AppLayout,
        MainArea,
        InventoryTabs,
        Card,
        SelectBox,
    },
    props: ["nurseries"],
    data() {
        return {
            selectedNursery: null,
            blocks: [],
            selectedBlock: null,
            places: [],
            form: this.$inertia.form({
                starting_row: null,
                ending_row: null,
            }),
        };
    },
    computed: {
        firstRowInBlock() {
            return this.places
                .map((place) => {
                    return place.row_number;
                })
                .sort((a, b) => a - b)[0];
        },
        lastRowInBlock() {
            return this.places
                .map((place) => {
                    return place.row_number;
                })
                .sort((a, b) => {
                    if (a < b) {
                        return 1;
                    } else if (a > b) {
                        return -1;
                    }
                })[0];
        },
    },
    watch: {
        selectedNursery() {
            this.getBlocks();
        },
        selectedBlock() {
            this.getPlaces();
        },
    },
    methods: {
        getBlocks() {
            this.blocks = [];
            this.selectedBlock = null;
            this.places = [];
            this.starting_row = null;
            this.ending_row = null;
            if (this.selectedNursery) {
                axios
                    .get(route("api.blocks.index", this.selectedNursery))
                    .then((res) => {
                        this.blocks = res.data;
                    });
            }
        },
        getPlaces() {
            if (this.selectedBlock) {
                axios
                    .get(route("api.places.index", this.selectedBlock))
                    .then((res) => {
                        this.places = res.data;
                    });
            }
        },
        clearLocations() {
            this.form.post(route("clear-locations.clear", this.selectedBlock));
        },
    },
};
</script>
