import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

// Mixin Methods
import date from "./utils/date";
import money from "./utils/money";
import popup from "./utils/popup";

// Global Components
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetSectionTitle from "@/Jetstream/SectionTitle.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import TextAreaInput from "@/Components/Forms/TextAreaInput.vue";
import SelectBox from "@/Components/Forms/SelectBox.vue";
import DetailsSection from "@/Components/DetailsSection.vue";
import MoneyInput from "@/Components/Forms/MoneyInput.vue";
import PercentageInput from "@/Components/Forms/PercentageInput.vue";
import { Link } from "@inertiajs/inertia-vue3";

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mixin({
                components: {
                    Link,
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
            .mount(el);
    },
});

InertiaProgress.init({
    delay: 250,
    color: "#29d",
    showSpinner: true,
    includeCSS: false,
});
