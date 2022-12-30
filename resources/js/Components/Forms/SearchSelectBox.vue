<template>
    <!-- <div class="form-control">
        <jet-label v-if="showLabel" for="items-input">{{
            labelValue
        }}</jet-label>
        <Combobox v-model="selected">
            <div class="relative mt-1">
                <div
                    class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
                >
                    <ComboboxInput
                        class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                        @change="search = $event.target.value"
                        :displayValue="(selected) => selected.name"
                    />
                    <ComboboxButton
                        class="absolute inset-y-0 right-0 flex items-center pr-2"
                    >
                        <ChevronUpDownIcon
                            class="h-5 w-5 text-gray-400"
                            aria-hidden="true"
                        />
                    </ComboboxButton>
                </div>
                <TransitionRoot
                    leave="transition ease-in duration-100"
                    leaveFrom="opacity-100"
                    leaveTo="opacity-0"
                    @after-leave="search = ''"
                >
                    <ComboboxOptions
                        class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                    >
                        <div
                            v-if="searchItems.length === 0 && search !== ''"
                            class="relative cursor-default select-none py-2 px-4 text-gray-700"
                        >
                            Nothing found.
                        </div>
                        <ComboboxOption
                            v-for="item in searchItems"
                            :key="item.id"
                            :value="item"
                            as="template"
                            v-slot="{ selected, active }"
                        >
                            {{ item.name }}
                        </ComboboxOption>
                    </ComboboxOptions>
                </TransitionRoot>
            </div>
        </Combobox>
    </div> -->
</template>

<script>
import {
    CheckIcon,
    XCircleIcon,
    ChevronUpDownIcon,
} from "@heroicons/vue/20/solid";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
} from "@headlessui/vue";

export default {
    components: {
        CheckIcon,
        XCircleIcon,
        ChevronUpDownIcon,
        JetInput,
        JetLabel,
        Combobox,
        ComboboxInput,
        ComboboxOption,
        ComboboxOptions,
    },
    props: {
        items: Array,
        selectedItem: Object | Boolean,
        labelValue: { type: String, default: "Select Option" },
        showLabel: { type: Boolean, default: true },
        nameValue: { type: String, default: "name" },
    },
    data: function () {
        return {
            search: this.selectedItem ? this.selectedItem[this.nameValue] : "",
            searchItems: this.items,
            selected: this.selectedItem,
            isOpen: false,
        };
    },
    methods: {
        filterItems: function (search) {
            this.searchItems = this.items.filter((item) =>
                item[this.nameValue]
                    .toLowerCase()
                    .includes(search.toLowerCase())
            );
        },
        updateItem: function (item) {
            if (item) {
                this.selected = item;
                this.isOpen = false;
            } else {
                this.addItem();
            }
        },
        addItem() {
            if (this.search.length > 1) {
                this.$emit("add", this.search);
                this.isOpen = false;
            }
        },
        clearSearch() {
            this.search = "";
            this.searchItems = this.items;
            document.getElementById("items-input").focus();
        },
        openIfNotEnter(e) {
            if (e.keyCode !== 13) {
                this.isOpen = true;
            }
        },
        isSelected(item) {
            return this.selected && this.selected.id === item.id;
        },
    },
    watch: {
        selectedItem: function (newValue) {
            this.selected = newValue;
        },
        items: function (newValue) {
            this.searchItems = newValue;
        },
        isOpen(isOpen) {
            if (!isOpen) {
                if (this.selected) {
                    this.search = this.selected[this.nameValue];
                }
            }
        },
        selectedItem() {
            this.selected = this.selectedItem;
        },
        selected(value) {
            if (value) {
                this.$emit("update", value.id);
                this.search = value[this.nameValue];
            }
        },
        search(searchValue) {
            // filter the items based on the search
            this.filterItems(searchValue);
        },
    },
};
</script>
<style scoped>
input::-webkit-calendar-picker-indicator {
    display: none;
    opacity: 0;
}
</style>
