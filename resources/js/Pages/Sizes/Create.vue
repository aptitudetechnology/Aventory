<template>
  <app-layout>
    <div class="flex-1 relative z-0 flex overflow-hidden">
      <main-area :dontShowOnMobile="false">
        <div class="py-2">
          <create-size-form />
        </div>
      </main-area>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MainArea from "@Components/MainArea.vue";
import CreateSizeForm from "./CreateSizeForm.vue";
export default {
  components: {
    AppLayout,
    MainArea,
    CreateSizeForm,
  },
  computed: {},
};
</script>
