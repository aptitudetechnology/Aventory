import{T as O,a as b}from"./TabLink.6500eaa0.js";import{E as k}from"./ErrorMessage.9555be26.js";import P from"./ProductHoldItem.e4f90bcd.js";import{L as w}from"./LoadingState.db280596.js";import{_ as x,r as i,o,J as d,b as c,w as u,a as l,c as a,W as y,X as p,M as h,N as g,d as v}from"./app.123e766a.js";import"./XCircleIcon.401ddebd.js";import"./SmallLineItem.a4ba7f2d.js";const z={components:{TabContainer:O,TabLink:b,ErrorMessage:k,ProductHoldItem:P,LoadingState:w},props:{orderId:{type:Number,required:!1},product:{type:[Object,Boolean],required:!1},size:{type:[Object,Boolean],required:!1}},mounted(){this.product&&this.getSoldAndHoldInventoryItemsForProduct(this.product)},data(){return{loading:!0,error:!1,onHoldInventoryQuoteItems:[],soldProductOrderItems:[],viewingOnHold:!0}},computed:{soldProductInventoryForSize(){return this.soldProductOrderItems.filter(t=>{var e;return t.size_id==((e=this.size)==null?void 0:e.id)})},onHoldProductInventoryForSize(){return this.onHoldInventoryQuoteItems.filter(t=>{var e;return t.size_id==((e=this.size)==null?void 0:e.id)})},quantitySold(){return this.soldProductInventoryForSize.reduce((t,e)=>t+e.quantity,0)},quantityOnHold(){return this.onHoldProductInventoryForSize.reduce((t,e)=>t+e.quantity,0)}},watch:{product(t){this.getSoldAndHoldInventoryItemsForProduct(t)}},methods:{getSoldAndHoldInventoryItemsForProduct(t){t?(this.error=!1,this.loading=!0,axios.get(route("api.products.orders.index",t)).then(e=>{this.onHoldInventoryQuoteItems=e.data.onHold,this.soldProductOrderItems=e.data.inventorySold,this.updateViewingOnHold()}).catch(e=>{this.error=!0,console.error(e.message)}).finally(()=>{this.loading=!1})):this.resetSoldAndHoldInventoryItems()},resetSoldAndHoldInventoryItems(){this.onHoldInventoryQuoteItems=[],this.soldProductOrderItems=[]},updateViewingOnHold(){this.viewingOnHold=this.quantityOnHold>this.quantitySold}}},F=v("On Hold"),q={class:"badge badge-outline badge-sm ml-2"},N=v("Sold"),V={class:"badge badge-outline badge-sm ml-2"},B={key:2,class:"py-4"},C={key:0},L=l("p",{class:"text-gray-600 px-2"},"No items on hold.",-1),A=[L],E={key:3,class:"py-4"},M={key:0},Q=l("p",{class:"text-gray-600 px-2"}," No items in uncompleted orders. ",-1),T=[Q];function j(t,e,I,D,r,s){const m=i("tab-link"),H=i("tab-container"),f=i("ErrorMessage"),S=i("LoadingState"),_=i("product-hold-item");return o(),d("div",null,[c(H,{class:"px-0 py-0 uppercase tracking-wide"},{default:u(()=>[c(m,{as:"button",current:r.viewingOnHold,class:"px-2",onClick:e[0]||(e[0]=n=>r.viewingOnHold=!0)},{default:u(()=>[F,l("span",q,g(s.quantityOnHold),1)]),_:1},8,["current"]),c(m,{as:"button",class:"px-2",current:!r.viewingOnHold,onClick:e[1]||(e[1]=n=>r.viewingOnHold=!1)},{default:u(()=>[N,l("span",V,g(s.quantitySold),1)]),_:1},8,["current"])]),_:1}),l("div",null,[r.error?(o(),a(f,{key:0})):r.loading?(o(),a(S,{key:1,loading:"loading"})):r.viewingOnHold?(o(),d("div",B,[(o(!0),d(y,null,p(s.onHoldProductInventoryForSize,n=>(o(),a(_,{item:n,key:n.id},null,8,["item"]))),128)),s.onHoldProductInventoryForSize.length?h("",!0):(o(),d("div",C,A))])):(o(),d("div",E,[(o(!0),d(y,null,p(s.soldProductInventoryForSize,n=>(o(),a(_,{item:n,orderId:I.orderId,key:n.id},null,8,["item","orderId"]))),128)),s.soldProductInventoryForSize.length?h("",!0):(o(),d("div",M,T))]))])])}var Y=x(z,[["render",j]]);export{Y as default};
