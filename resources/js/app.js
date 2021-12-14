require("./bootstrap");

// Import modules...
import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import money from "./utils/money";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetSectionTitle from "@/Jetstream/SectionTitle";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import TextAreaInput from "@/Components/Forms/TextAreaInput";
import SelectBox from "@Components/Forms/SelectBox";
import DetailsSection from "@Components/DetailsSection";
import MoneyInput from "@Components/Forms/MoneyInput";

const el = document.getElementById("app");

const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
});

app.mixin({
    methods: { route },
    components: {
        JetLabel,
        JetInput,
        JetInputError,
        JetCheckbox,
        JetSectionTitle,
        JetButton,
        JetSecondaryButton,
        TextAreaInput,
        SelectBox,
        DetailsSection,
        MoneyInput,
    },
})
    .mixin(money)
    .use(InertiaPlugin);

app.mount(el);

InertiaProgress.init({
    delay: 250,
    color: "#29d",
    showSpinner: true,
    includeCSS: false,
});
