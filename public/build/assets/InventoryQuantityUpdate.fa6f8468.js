import{_ as l,a2 as p,a5 as c,r as n,o as d,J as m,b as o,w as y,M as f,d as _}from"./app.123e766a.js";const v={components:{JetInput:p,JetLabel:c},props:{inventory:Object},data(){return{form:this.$inertia.form(this.inventory)}},methods:{updateInventory(){this.form.patch(route("inventory.update",this.inventory))}}},h={key:0,class:"py-4 w-full flex items-center space-x-2"},x=_("Quantity in Group");function b(V,t,a,w,e,r){const s=n("JetLabel"),u=n("jet-input");return a.inventory.type=="group"?(d(),m("div",h,[o(s,{for:"quantity",class:"text-lg w-full"},{default:y(()=>[x]),_:1}),o(u,{id:"quantity",type:"number",onChange:r.updateInventory,modelValue:e.form.quantity,"onUpdate:modelValue":t[0]||(t[0]=i=>e.form.quantity=i),class:"block w-full"},null,8,["onChange","modelValue"])])):f("",!0)}var J=l(v,[["render",b]]);export{J as default};
