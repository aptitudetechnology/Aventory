export default {
    methods: {
        // @params href: string
        // @params title: string
        // @params width: number
        // @params height: number
        showPopup(href, title, width = 1024, height = 768) {
            let params = `popup,width=${width},height=${height}`;
            window.open(href, title, params);
        },
    },
};
