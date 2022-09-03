<script setup>
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ReportsLayout from "./ReportsLayout.vue";
import ContainerSpaceBetween from "../../Components/Structure/ContainerSpaceBetween.vue";
import ContainerPaddingX from "../../Components/Structure/ContainerPaddingX.vue";
import ContainerFlexHorizontal from "@/Components/Structure/ContainerFlexHorizontal.vue";
import BirdsEyeReports from "./Components/BirdsEyeReports.vue";
</script>

<template>
    <reports-layout>
        <container-space-between>
            <container-padding-x>
                <container-flex-horizontal>
                    <heading-one>Reports</heading-one>
                </container-flex-horizontal>
            </container-padding-x>
            <birds-eye-reports />
        </container-space-between>
    </reports-layout>
</template>
