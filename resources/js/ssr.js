import { createSSRApp, h } from "vue";
import { renderToString } from "@vue/server-renderer";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import createServer from "@inertiajs/server";
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

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: (name) =>
            resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob("./Pages/**/*.vue")
            ),
        setup({ app, props, plugin }) {
            return createSSRApp({ render: () => h(app, props) })
                .use(plugin)
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
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });
        },
    })
);
