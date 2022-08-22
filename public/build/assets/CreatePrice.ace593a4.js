import{_ as v,a0 as y,a2 as P,a4 as x,a5 as z,a6 as j,aa as V,a9 as k,r as s,o as C,J,b as o,w as i,a as r,L as c,O as B,d as l}from"./app.123e766a.js";import{J as L}from"./DialogModal.11efde9a.js";import{J as D}from"./ActionMessage.df590980.js";import{S as I,a as N,b as O,c as U}from"./switch.esm.cc9d415a.js";import"./Modal.c06c0ace.js";import"./description.esm.8bb4746d.js";import"./label.esm.25c1a873.js";const A={components:{Switch:I,SwitchDescription:N,SwitchGroup:O,SwitchLabel:U,JetActionMessage:D,JetButton:y,JetDialogModal:L,JetInput:P,JetInputError:x,JetLabel:z,JetSecondaryButton:j,TextAreaInput:V,SelectBox:k},props:{product:Object,category:Object},data(){return{sizes:this.$page.props.sizes,selectedSize:null,creatingProductPrice:!1,form:this.$inertia.form({_method:"POST",product_id:this.product?this.product.id:null,category_id:this.category?this.category.id:null,size_id:null,unit_price:null,show_on_availability:!0})}},watch:{selectedSize(){this.selectedSize&&(this.form.size_id=this.selectedSize.id)}},methods:{createPrice(){this.form.post(route("prices.store"),{preserveScroll:!1,preserveState:!0,onSuccess:()=>{this.form.reset(),this.selectedSize=null,this.creatingProductPrice=!1}})}}},G=l("New Size & Price"),M=l("Create a Size and Price"),T=l(" Add a size for this product, and give it a base price. "),E={class:"col-span-6"},q={class:"grid gap-4 sm:grid-cols-2"},Y={class:"sm:col-span-1"},F={class:"sm:col-span-1"},H={class:"flex-grow flex flex-col"},K=l("Show this product size and price on the availability?"),Q=l("You can uncheck this to make sure this price and size will not be displayed in availability lists. Inventory value reports will still contain this product and size if in inventory."),R={class:"flex justify-between w-full"},W=l("Cancel"),X=l("Save Price");function Z($,t,ee,te,e,a){const u=s("jet-button"),p=s("select-box"),d=s("jet-input-error"),_=s("jet-label"),m=s("jet-input"),f=s("SwitchLabel"),h=s("SwitchDescription"),b=s("Switch"),g=s("SwitchGroup"),w=s("jet-secondary-button"),S=s("jet-dialog-modal");return C(),J("div",null,[o(u,{onClick:t[0]||(t[0]=n=>e.creatingProductPrice=!0)},{default:i(()=>[G]),_:1}),o(S,{show:e.creatingProductPrice,onClose:t[6]||(t[6]=n=>e.creatingProductPrice=!1)},{title:i(()=>[M]),description:i(()=>[T]),content:i(()=>[r("form",{onSubmit:t[4]||(t[4]=B((...n)=>a.createPrice&&a.createPrice(...n),["prevent"]))},[r("div",E,[r("div",q,[r("div",Y,[o(p,{labelValue:"Product Size",items:e.sizes,modelValue:e.selectedSize,"onUpdate:modelValue":t[1]||(t[1]=n=>e.selectedSize=n)},null,8,["items","modelValue"]),o(d,{message:e.form.errors.size_id,class:"mt-2"},null,8,["message"])]),r("div",F,[o(_,{for:"unit_price",value:"Unit Price"}),o(m,{id:"unit_price",type:"number",step:"0.01",class:"mt-1 block w-full",modelValue:e.form.unit_price,"onUpdate:modelValue":t[2]||(t[2]=n=>e.form.unit_price=n),required:""},null,8,["modelValue"]),o(d,{message:e.form.errors.unit_price,class:"mt-2"},null,8,["message"])]),o(g,{as:"div",class:"flex items-center justify-between sm:col-span-3"},{default:i(()=>[r("span",H,[o(f,{as:"span",class:"text-sm font-medium text-gray-900"},{default:i(()=>[K]),_:1}),o(h,{as:"span",class:"text-sm text-gray-500"},{default:i(()=>[Q]),_:1})]),o(b,{modelValue:e.form.show_on_availability,"onUpdate:modelValue":t[3]||(t[3]=n=>e.form.show_on_availability=n),class:c([e.form.show_on_availability?"bg-green-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"])},{default:i(()=>[r("span",{"aria-hidden":"true",class:c([e.form.show_on_availability?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"])},null,2)]),_:1},8,["modelValue","class"])]),_:1})])])],32)]),footer:i(()=>[r("div",R,[o(w,{type:"button",onClick:t[5]||(t[5]=n=>e.creatingProductPrice=!1)},{default:i(()=>[W]),_:1}),o(u,{type:"submit",onClick:a.createPrice,class:c({"opacity-25":e.form.processing}),disabled:e.form.processing},{default:i(()=>[X]),_:1},8,["onClick","class","disabled"])])]),_:1},8,["show"])])}var ce=v(A,[["render",Z]]);export{ce as default};
