require("./bootstrap");

// Import modules...
import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

// Mixin Methods
import date from "./utils/date";
import money from "./utils/money";
import popup from "./utils/popup";

// Global Components
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetSectionTitle from "@/Jetstream/SectionTitle";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDangerButton from "@/Jetstream/DangerButton";
import TextAreaInput from "@/Components/Forms/TextAreaInput";
import SelectBox from "@Components/Forms/SelectBox";
import DetailsSection from "@Components/DetailsSection";
import MoneyInput from "@Components/Forms/MoneyInput";
import PercentageInput from "@Components/Forms/PercentageInput";

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
        JetDangerButton,
        TextAreaInput,
        SelectBox,
        DetailsSection,
        MoneyInput,
        PercentageInput,
    },
})
    .mixin(date)
    .mixin(money)
    .mixin(popup)
    .use(InertiaPlugin);

app.mount(el);

InertiaProgress.init({
    delay: 250,
    color: "#29d",
    showSpinner: true,
    includeCSS: false,
});
