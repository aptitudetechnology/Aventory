import{_ as I,a0 as P,a2 as k,a4 as x,a5 as q,a6 as j,aa as C,a9 as J,r as l,o as d,J as U,b as o,w as n,a as r,c as m,M as c,L as h,O as B,a8 as E,d as a}from"./app.fbac1591.js";import{J as O}from"./DialogModal.895d1aec.js";import{J as L}from"./ActionMessage.d9a25167.js";import{E as M}from"./EditButton.61c06f0c.js";import{S as N,a as D,b as G,c as A}from"./switch.esm.c6988def.js";import"./Modal.bd4b42b5.js";import"./PencilIcon.dfaad940.js";import"./description.esm.86a5930e.js";import"./label.esm.e5d54681.js";const K={components:{Switch:N,SwitchDescription:D,SwitchGroup:G,SwitchLabel:A,JetActionMessage:L,JetButton:P,JetDialogModal:O,JetInput:k,JetInputError:x,JetLabel:q,JetSecondaryButton:j,TextAreaInput:C,SelectBox:J,EditButton:M},props:{purchaseItem:Object},data(){return{products:this.$page.props.products,sizes:this.$page.props.sizes,selectedProduct:this.$page.props.products.find(i=>i.id==this.purchaseItem.product_id),selectedOriginalSize:this.$page.props.sizes.find(i=>i.id==this.purchaseItem.original_size_id),selectedSize:this.$page.props.sizes.find(i=>i.id==this.purchaseItem.size_id),updatingPurchaseItem:!1,form:this.$inertia.form(this.purchaseItem)}},watch:{selectedProduct(){this.selectedProduct?this.form.product_id=this.selectedProduct.id:this.form.product_id=null},selectedOriginalSize(i){i?(this.form.original_size_id=i.id,this.selectedSize||(this.selectedSize=i)):this.form.original_size_id=null},selectedSize(i){i?this.form.size_id=i.id:this.form.size_id=null}},methods:{updatePurchaseItem(){this.form.patch(route("purchase-item.update",this.purchaseItem),{preserveScroll:!0,preserveState:!1})}}},Q=a("Edit"),R=a("Edit"),T=a(" Edit this purchase item. "),F={class:"col-span-6 grid gap-4"},H={class:"grid gap-4 sm:grid-cols-2"},W={class:"sm:col-span-2 min-w-0"},X={class:"sm:col-span-1"},Y={class:"sm:col-span-1"},Z={class:"grid gap-4 grid-cols-1 sm:grid-cols-3"},$={class:"sm:col-span-1"},ee={class:"sm:col-span-1"},se={class:"sm:col-span-1"},te={class:"grid gap-4 grid-cols-1 sm:grid-cols-2"},oe={class:"sm:col-span-1"},re=a("Received?"),ie={class:"flex justify-between w-full"},le=a("Cancel"),ne=a("Save Item");function de(i,s,ue,me,e,p){const y=l("edit-button"),g=l("select-box"),u=l("jet-input-error"),_=l("jet-label"),f=l("jet-input"),b=l("SwitchLabel"),v=l("Switch"),S=l("SwitchGroup"),V=l("jet-secondary-button"),w=l("jet-button"),z=l("jet-dialog-modal");return d(),U("div",null,[o(y,{onClick:s[0]||(s[0]=t=>e.updatingPurchaseItem=!0)},{default:n(()=>[Q]),_:1}),o(z,{show:e.updatingPurchaseItem,onClose:s[12]||(s[12]=t=>e.updatingPurchaseItem=!1)},{title:n(()=>[R]),description:n(()=>[T]),content:n(()=>[r("form",{onSubmit:s[9]||(s[9]=B((...t)=>p.updatePurchaseItem&&p.updatePurchaseItem(...t),["prevent"])),onKeydown:s[10]||(s[10]=E((...t)=>p.updatePurchaseItem&&p.updatePurchaseItem(...t),["enter"]))},[r("div",F,[r("div",H,[r("div",W,[o(g,{labelValue:"Product",items:e.products,selectedItem:e.selectedProduct,modelValue:e.selectedProduct,"onUpdate:modelValue":s[1]||(s[1]=t=>e.selectedProduct=t)},null,8,["items","selectedItem","modelValue"]),e.form.product_id?c("",!0):(d(),m(u,{key:0,message:e.form.errors.product_id,class:"mt-2"},null,8,["message"]))]),r("div",X,[o(g,{labelValue:"Purchase Size",items:e.sizes,selectedItem:e.selectedOriginalSize,modelValue:e.selectedOriginalSize,"onUpdate:modelValue":s[2]||(s[2]=t=>e.selectedOriginalSize=t)},null,8,["items","selectedItem","modelValue"]),e.form.size_id?c("",!0):(d(),m(u,{key:0,message:e.form.errors.size_id,class:"mt-2"},null,8,["message"]))]),r("div",Y,[o(g,{labelValue:"Size",items:e.sizes,selectedItem:e.selectedSize,modelValue:e.selectedSize,"onUpdate:modelValue":s[3]||(s[3]=t=>e.selectedSize=t)},null,8,["items","selectedItem","modelValue"]),e.form.size_id?c("",!0):(d(),m(u,{key:0,message:e.form.errors.size_id,class:"mt-2"},null,8,["message"]))])]),r("div",Z,[r("div",$,[o(_,{for:"quantity_ordered",value:"Quantity Purchaseed"}),o(f,{id:"quantity_ordered",type:"number",step:"1",class:"mt-1 block w-full",modelValue:e.form.quantity_ordered,"onUpdate:modelValue":s[4]||(s[4]=t=>e.form.quantity_ordered=t),required:""},null,8,["modelValue"]),e.form.quantity_ordered?c("",!0):(d(),m(u,{key:0,message:e.form.errors.quantity_ordered,class:"mt-2"},null,8,["message"]))]),r("div",ee,[o(_,{for:"quantity_confirmed",value:"Quantity Confirmed"}),o(f,{id:"quantity_confirmed",type:"number",step:"1",class:"mt-1 block w-full",modelValue:e.form.quantity_confirmed,"onUpdate:modelValue":s[5]||(s[5]=t=>e.form.quantity_confirmed=t),required:""},null,8,["modelValue"]),e.form.quantity_confirmed?c("",!0):(d(),m(u,{key:0,message:e.form.errors.quantity_confirmed,class:"mt-2"},null,8,["message"]))]),r("div",se,[o(_,{for:"unit_price",value:"Unit Price"}),o(f,{id:"unit_price",type:"number",step:"0.01",class:"mt-1 block w-full",modelValue:e.form.unit_price,"onUpdate:modelValue":s[6]||(s[6]=t=>e.form.unit_price=t),required:""},null,8,["modelValue"]),e.form.unit_price?c("",!0):(d(),m(u,{key:0,message:e.form.errors.unit_price,class:"mt-2"},null,8,["message"]))])]),r("div",te,[r("div",oe,[o(_,{for:"ready_date",value:"Ready Date"}),o(f,{id:"ready_date",type:"date",class:"mt-1 block w-full",modelValue:e.form.ready_date,"onUpdate:modelValue":s[7]||(s[7]=t=>e.form.ready_date=t),required:""},null,8,["modelValue"]),e.form.ready_date?c("",!0):(d(),m(u,{key:0,message:e.form.errors.ready_date,class:"mt-2"},null,8,["message"]))]),o(S,{as:"div",class:"flex justify-start items-center sm:col-span-1"},{default:n(()=>[o(b,{as:"span",class:"text-sm font-medium text-gray-900 mr-4"},{default:n(()=>[re]),_:1}),o(v,{modelValue:e.form.received,"onUpdate:modelValue":s[8]||(s[8]=t=>e.form.received=t),class:h([e.form.received?"bg-green-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"])},{default:n(()=>[r("span",{"aria-hidden":"true",class:h([e.form.received?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"])},null,2)]),_:1},8,["modelValue","class"])]),_:1})])])],32)]),footer:n(()=>[r("div",ie,[o(V,{type:"button",onClick:s[11]||(s[11]=t=>e.updatingPurchaseItem=!1)},{default:n(()=>[le]),_:1}),o(w,{type:"submit",onClick:p.updatePurchaseItem,class:h({"opacity-25":e.form.processing}),disabled:e.form.processing},{default:n(()=>[ne]),_:1},8,["onClick","class","disabled"])])]),_:1},8,["show"])])}var ve=I(K,[["render",de]]);export{ve as default};