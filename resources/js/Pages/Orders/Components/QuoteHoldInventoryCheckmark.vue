<template>
    <div class="col-span-2 justify-self-end">
        <div class="form-control">
            <label class="cursor-pointer label">
                <span class="label-text mr-4">{{ holdInventoryLabel }}</span>
                <input
                    id="hold_inventory"
                    type="checkbox"
                    class="toggle"
                    v-model="proxyChecked"
                />
            </label>
        </div>
        <jet-input-error :message="errorMessage" class="mt-2" />
    </div>
</template>
<script>
export default {
    props: {
        modelValue: {},
        errorMessage: {
            type: String,
            required: false,
        },
    },
    computed: {
        holdInventoryLabel() {
            return this.modelValue
                ? "Inventory on hold until quote expires."
                : "Hold Inventory?";
        },
        proxyChecked: {
            get() {
                return this.modelValue;
            },

            set(val) {
                this.$emit("update:modelValue", val);
            },
        },
    },
    emits: ["update:modelValue"],
};
</script>
