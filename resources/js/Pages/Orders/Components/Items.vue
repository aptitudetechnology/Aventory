<template>
    <div>
        <jet-section-title>
            <template #title>Products and Services</template>
            <template #aside
                ><create-order-item
                    class="ml-auto flex justify-end"
                    :order="order"
                ></create-order-item
            ></template>
        </jet-section-title>

        <div class="">
            <order-line-item
                @selected="toggleSelected(item)"
                v-for="item in items"
                :key="item.id"
                :item="item"
                :itemSelected="isItemSelected(item)"
            />
        </div>
    </div>
</template>

<script>
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import CreateOrderItem from "./ItemCreate.vue";
import OrderLineItem from "./ItemLine.vue";
export default {
    props: { order: Object },

    components: {
        JetCheckbox,
        JetLabel,
        JetButton,
        JetSectionTitle,

        CreateOrderItem,
        OrderLineItem,
    },

    data() {
        return {
            allSelected: false,
            selected: [],
            items: this.$page.props.items,
        };
    },

    watch: {
        "$page.props.items"(items) {
            this.items = items;
        },
        selected() {
            //watches selected to uncheck the select all checkbox if selected is empty
            let selectedLength = this.selected.length;

            if (selectedLength === 0) {
                this.allSelected = false;
            }
        },
    },

    methods: {
        toggleSelected(item) {
            if (this.selected.includes(item.id)) {
                this.selected = this.selected.filter((id) => id != item.id);
            } else {
                this.selected.push(item.id);
            }
        },

        isItemSelected(item) {
            return this.selected.includes(item.id);
        },

        toggleAllSelected() {
            if (this.allSelected) {
                this.selected = this.items.map((item) => item.id);
            } else {
                this.selected = [];
            }
        },
    },
};
</script>
