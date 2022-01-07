import moment from "moment";

export default {
    methods: {
        // @params href: string
        // @returns formated Date
        formatDate: (value) => moment(value).format("MM/DD/YYYY"),
    },
};
