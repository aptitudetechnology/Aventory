export default {
  methods:{
    formatMoney(value, currency = 'USD'){
      let formatter = new Intl.NumberFormat(['en-US'], {
        style: 'currency',
        currency: currency,
        minimumFractionDigits: 2
      });
      return formatter.format(value);
    }
  }
}