import{E as p}from"./ErrorMessage.e1cd30fd.js";import{_ as u,o as i,J as r,a as s,r as n,b as a,w as v,V as m,c as l}from"./app.9dc34ef4.js";import"./XCircleIcon.615c78c3.js";const y={},_={class:"alert alert-info"},g=s("div",{class:"flex-1"},[s("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",class:"w-6 h-6 mx-2 stroke-current"},[s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"})]),s("label",null,"Loading...")],-1),f=[g];function b(t,d){return i(),r("div",_,f)}var q=u(y,[["render",b]]);const x={components:{ErrorMessage:p,Loading:q},props:{product:Object|Boolean,size:Object|Boolean},data(){return{loading:!1,error:!1,quantities:{inNursery:0,availableForSale:0,onHold:0,ready:0}}},mounted(){this.getQuantities()},watch:{product(){this.getQuantities()},size(){this.getQuantities()},quantities:{handler(){this.$emit("update",this.quantities)},deep:!0}},methods:{getQuantities(){this.product&&this.size?(this.error=!1,this.loading=!0,axios.get(route("api.inventory.quantities",[this.product.id,this.size.id])).then(t=>{this.quantities.inNursery=t.data.total,this.quantities.ready=t.data.ready,this.quantities.onHold=t.data.on_hold,this.quantities.availableForSale=t.data.available}).catch(t=>{this.error=!0,console.error(t.message)}).finally(()=>{this.loading=!1})):this.resetQuantities()},resetQuantities(){this.quantities.inNursery=0,this.quantities.ready=0,this.quantities.onHold=0,this.quantities.availableForSale=0}}},k={key:2,class:"flex flex-col items-end sm:text-right divide-y"};function w(t,d,B,N,e,F){const c=n("ErrorMessage"),h=n("Loading"),o=n("jet-label");return i(),r("div",null,[a(m,{name:"fade",mode:"out-in"},{default:v(()=>[e.error?(i(),l(c,{key:0})):e.loading?(i(),l(h,{key:1})):(i(),r("div",k,[a(o,{"data-tip":"The total amount of these items in inventory. They may be ready, but their ready date states not.",class:"py-2 mr-0 tooltip lg:tooltip-right",value:"Total In Nursery: "+e.quantities.inNursery},null,8,["value"]),a(o,{"data-tip":"Inventory that is ready to sell - inventory in orders that haven't been completed yet.",class:"py-2 mr-0 tooltip lg:tooltip-right",value:"Ready to sell: "+e.quantities.availableForSale},null,8,["value"]),a(o,{class:"py-2 mr-0",value:"On Hold: "+e.quantities.onHold},null,8,["value"]),a(o,{"data-tip":"The amount ready to sell - the amount of inventory in active quotes on hold.",class:"py-2 mr-0 font-bold text-base tooltip lg:tooltip-right",value:"Available For Sale: "+e.quantities.availableForSale},null,8,["value"])]))]),_:1})])}var z=u(x,[["render",w]]);export{z as default};
