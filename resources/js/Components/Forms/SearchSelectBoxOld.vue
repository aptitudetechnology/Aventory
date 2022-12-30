<template>
    <div class="form-control">
        <jet-label v-if="showLabel" for="items-input">{{
            labelValue
        }}</jet-label>
        <div
            v-if="isOpen"
            class="fixed inset-0 z-10"
            @click="isOpen = false"
        ></div>
        <div class="relative z-20">
            <jet-input
                type="text"
                autocomplete="off"
                @keydown.enter.prevent="updateItem(searchItems[0])"
                @click="isOpen = true"
                @keydown="openIfNotEnter"
                id="items-input"
                :placeholder="'Select ' + labelValue"
                v-model="search"
                class="w-full"
            />
            <span
                class="absolute inset-y-0 right-0 flex items-center pr-2"
                :class="isOpen && search.length ? '' : 'pointer-events-none'"
            >
                <XCircleIcon
                    @click="clearSearch"
                    v-if="search.length && isOpen"
                    :class="[
                        'h-5 w-5',
                        isOpen ? 'text-gray-900' : 'text-gray-500',
                    ]"
                />
                <ChevronUpDownIcon
                    v-else
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </span>
            <div
                v-show="isOpen"
                id="items-list"
                class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-gray-700 ring-opacity-5 overflow-auto focus:outline-none sm:text-sm group"
            >
                <div
                    v-for="(item, index) in searchItems"
                    key="item.id"
                    @click="updateItem(item)"
                    @keydown.enter="updateItem(item)"
                    :tabindex="isOpen ? '0' : '-1'"
                    class="group text-gray-900 cursor-default relative py-2 pl-3 pr-9 bg-white active:outline-none focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-gray-500 focus:bg-gray-500 focus:text-white"
                    :class="[
                        isSelected(item) ? 'font-semibold' : 'font-normal',
                        'block truncate',
                    ]"
                >
                    {{ item[nameValue] }}
                    <span
                        v-if="isSelected(item)"
                        class="group-focus:text-white text-gray-500 absolute inset-y-0 right-0 flex items-center pr-4"
                    >
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                    </span>
                </div>
                <div
                    @click="addItem"
                    @keydown.enter="addItem"
                    tabindex="0"
                    class="focus:text-white cursor-default relative py-2 pl-3 pr-9 focus:bg-gray-500 active:outline-none focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-gray-500"
                >
                    {{ `Add ${search}?` }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronUpDownIcon, XCircleIcon } from "@heroicons/vue/20/solid";
import { CheckIcon } from "@heroicons/vue/20/solid";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

export default {
    components: {
        CheckIcon,
        ChevronUpDownIcon,
        XCircleIcon,
        JetInput,
        JetLabel,
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
