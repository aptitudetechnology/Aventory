<template>
    <div>
        <jet-label v-if="showLabel" for="items-input" class="pb-1">{{
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
                class="
                    bg-white
                    relative
                    w-full
                    border border-gray-300
                    rounded-md
                    shadow-sm
                    placeholder-gray-600
                    pl-3
                    pr-10
                    py-2
                    text-left
                    cursor-default
                    focus:outline-none
                    focus:ring-1
                    focus:ring-green-500
                    focus:border-green-500
                "
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
                <SelectorIcon
                    v-else
                    class="h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </span>
            <div
                v-show="isOpen"
                id="items-list"
                class="
                    absolute
                    z-10
                    mt-1
                    w-full
                    bg-white
                    shadow-lg
                    max-h-60
                    rounded-md
                    py-1
                    text-base
                    ring-1 ring-green-500 ring-opacity-5
                    overflow-auto
                    focus:outline-none
                    sm:text-sm
                    group
                "
            >
                <div
                    v-if="!searchItems.length"
                    @click="addItem"
                    @keydown.enter="addItem"
                    tabindex="0"
                    class="
                        text-white
                        cursor-default
                        relative
                        py-2
                        pl-3
                        pr-9
                        bg-green-500
                        active:outline-none
                        focus:outline-none
                        focus:ring-1
                        focus:ring-green-500
                        focus:border-green-500
                    "
                >
                    {{ `Add ${search}?` }}
                </div>
                <div
                    v-for="(item, index) in searchItems"
                    key="item.id"
                    @click="updateItem(item)"
                    @keydown.enter="updateItem(item)"
                    :tabindex="isOpen ? '0' : '-1'"
                    class="
                        group
                        text-gray-900
                        cursor-default
                        relative
                        py-2
                        pl-3
                        pr-9
                        bg-white
                        active:outline-none
                        focus:outline-none
                        focus:ring-1
                        focus:ring-green-500
                        focus:border-green-500
                        focus:bg-green-500
                        focus:text-white
                    "
                >
                    {{ item[nameValue] }}
                    <span
                        v-if="selected?.id == item.id"
                        class="
                            group-focus:text-white
                            text-green-500
                            absolute
                            inset-y-0
                            right-0
                            flex
                            items-center
                            pr-4
                        "
                    >
                        <CheckIcon class="h-5 w-5" aria-hidden="true" />
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { CheckIcon, SelectorIcon, XCircleIcon } from "@heroicons/vue/solid";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

export default {
    components: {
        CheckIcon,
        SelectorIcon,
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
            search: "",
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
            if (this.search.length) {
                this.$emit("add", this.search);
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
    },
    watch: {
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
