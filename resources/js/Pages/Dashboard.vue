<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import MainArea from "@/Components/MainArea.vue";
import HeadingOne from "@/Components/Headings/HeadingOne.vue";
import ContainerSpaceBetween from "@/Components/Structure/ContainerSpaceBetween.vue";
import ContainerPaddingX from "@/Components/Structure/ContainerPaddingX.vue";
import ContainerFlexHorizontal from "../Components/Structure/ContainerFlexHorizontal.vue";
import BirdsEyeReports from "./Reports/Components/BirdsEyeReports.vue";
import ButtonLink from "@/Components/Links/ButtonLink.vue";
import NewOrderNewQuote from "@/Components/Navigation/NewOrderNewQuote.vue";
</script>

<template>
    <app-layout>
        <main-area :dontShowOnMobile="false">
            <container-space-between>
                <container-padding-x>
                    <container-flex-horizontal>
                        <heading-one>Dashboard</heading-one>
                        <new-order-new-quote />
                    </container-flex-horizontal>
                </container-padding-x>
                <birds-eye-reports />
            </container-space-between>
        </main-area>
    </app-layout>
</template>
