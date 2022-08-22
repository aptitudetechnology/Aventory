import{_ as x,a0 as w,a2 as k,a4 as S,a5 as z,a6 as U,aa as j,a9 as J,r as i,o as g,c as B,w as r,d,N as M,a as l,b as s,L as c,J as A,M as C}from"./app.123e766a.js";import{J as N}from"./FormSection.a31e0947.js";import{J as D}from"./ActionMessage.df590980.js";import{S as I,a as L,b as G,c as T}from"./switch.esm.cc9d415a.js";import"./description.esm.8bb4746d.js";import"./label.esm.25c1a873.js";const E={components:{JetActionMessage:D,JetButton:w,JetFormSection:N,JetInput:k,JetInputError:S,JetLabel:z,JetSecondaryButton:U,Switch:I,SwitchDescription:L,SwitchGroup:G,SwitchLabel:T,TextAreaInput:j,SelectBox:J},props:{vendor:Object},data(){return{form:this.$inertia.form({_method:"PATCH",name:this.vendor.name,vendor_code:this.vendor.vendor_code,address:this.vendor.address,city:this.vendor.city,state:this.vendor.state,zip:this.vendor.zip,mailing_same_as_primary:this.vendor.mailing_same_as_primary,mailing_address:this.vendor.mailing_address,mailing_city:this.vendor.mailing_city,mailing_state:this.vendor.mailing_state,mailing_zip:this.vendor.mailing_zip,notes:this.vendor.notes,use_for_block_transfers:this.vendor.use_for_block_transfers})}},methods:{updateVendor(){this.form.patch(route("vendors.update",this.vendor),{errorBag:"updateVendor",preserveScroll:!0})}}},F={class:"col-span-6"},P={class:"grid gap-4"},Z={class:"col-span-3"},q={class:"col-span-3"},H={class:"flex-grow flex flex-col"},O=d("Use vendor for block inventory transfers?"),K=d("Indicate whether this vendor will be used for transfers from the block inventory."),Q={class:"grid gap-4"},R=l("div",{class:"col-span-3 pt-6"},[l("h3",{class:"text-lg leading-6 text-gray-900"}," Primary Address ")],-1),W={class:"col-span-3"},X={class:"col-span-3 sm:col-span-1"},Y={class:"col-span-3 sm:col-span-1"},$={class:"col-span-3 sm:col-span-1"},ee={class:"flex-grow flex flex-col"},se=d("Mailing same as primary"),oe=d("Indicate whether the mailing address of this vendor is the same as the primary address."),te={key:0,class:"grid gap-4"},le=l("div",{class:"col-span-3 pt-6"},[l("h3",{class:"text-lg leading-6 text-gray-900"}," Mailing Address ")],-1),re={class:"col-span-3"},ne={class:"col-span-3 sm:col-span-1"},ae={class:"col-span-3 sm:col-span-1"},ie={class:"col-span-3 sm:col-span-1"},me=d("Save Vendor");function de(ce,o,v,ue,e,h){const n=i("jet-label"),m=i("jet-input"),a=i("jet-input-error"),y=i("text-area-input"),u=i("SwitchLabel"),p=i("SwitchDescription"),_=i("Switch"),f=i("SwitchGroup"),b=i("jet-button"),V=i("jet-form-section");return g(),B(V,{onSubmitted:h.updateVendor},{title:r(()=>[d(M(v.vendor.name),1)]),form:r(()=>[l("div",F,[l("div",P,[l("div",Z,[s(n,{for:"name",value:"Vendor Name"}),s(m,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:e.form.name,"onUpdate:modelValue":o[0]||(o[0]=t=>e.form.name=t),required:"",autocomplete:"organization"},null,8,["modelValue"]),s(a,{message:e.form.errors.name,class:"mt-2"},null,8,["message"])]),l("div",q,[s(n,{for:"notes",value:"Vendor Notes"}),s(y,{id:"notes",class:"mt-1 block w-full",modelValue:e.form.notes,"onUpdate:modelValue":o[1]||(o[1]=t=>e.form.notes=t)},null,8,["modelValue"]),s(a,{message:e.form.errors.notes,class:"mt-2"},null,8,["message"])]),s(f,{as:"div",class:"flex items-center justify-between col-span-3"},{default:r(()=>[l("span",H,[s(u,{as:"span",class:"text-sm text-gray-900"},{default:r(()=>[O]),_:1}),s(p,{as:"span",class:"text-sm text-gray-500"},{default:r(()=>[K]),_:1})]),s(_,{modelValue:e.form.use_for_block_transfers,"onUpdate:modelValue":o[2]||(o[2]=t=>e.form.use_for_block_transfers=t),class:c([e.form.use_for_block_transfers?"bg-green-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"])},{default:r(()=>[l("span",{"aria-hidden":"true",class:c([e.form.use_for_block_transfers?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"])},null,2)]),_:1},8,["modelValue","class"])]),_:1})]),l("div",Q,[R,l("div",W,[s(n,{for:"address",value:"Street Address"}),s(m,{id:"address",type:"text",class:"mt-1 block w-full",modelValue:e.form.address,"onUpdate:modelValue":o[3]||(o[3]=t=>e.form.address=t),autocomplete:"address"},null,8,["modelValue"]),s(a,{message:e.form.errors.address,class:"mt-2"},null,8,["message"])]),l("div",X,[s(n,{for:"city",value:"City"}),s(m,{id:"city",type:"text",class:"mt-1 block w-full",modelValue:e.form.city,"onUpdate:modelValue":o[4]||(o[4]=t=>e.form.city=t),autocomplete:"address-level2"},null,8,["modelValue"]),s(a,{message:e.form.errors.city,class:"mt-2"},null,8,["message"])]),l("div",Y,[s(n,{for:"state",value:"State"}),s(m,{id:"state",type:"text",class:"mt-1 block w-full",modelValue:e.form.state,"onUpdate:modelValue":o[5]||(o[5]=t=>e.form.state=t),autocomplete:"address-level1"},null,8,["modelValue"]),s(a,{message:e.form.errors.state,class:"mt-2"},null,8,["message"])]),l("div",$,[s(n,{for:"zip",value:"Zip"}),s(m,{id:"zip",type:"text",class:"mt-1 block w-full",modelValue:e.form.zip,"onUpdate:modelValue":o[6]||(o[6]=t=>e.form.zip=t),autocomplete:"postal-code"},null,8,["modelValue"]),s(a,{message:e.form.errors.zip,class:"mt-2"},null,8,["message"])]),s(f,{as:"div",class:"flex items-center justify-between col-span-3"},{default:r(()=>[l("span",ee,[s(u,{as:"span",class:"text-sm text-gray-900"},{default:r(()=>[se]),_:1}),s(p,{as:"span",class:"text-sm text-gray-500"},{default:r(()=>[oe]),_:1})]),s(_,{modelValue:e.form.mailing_same_as_primary,"onUpdate:modelValue":o[7]||(o[7]=t=>e.form.mailing_same_as_primary=t),class:c([e.form.mailing_same_as_primary?"bg-green-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"])},{default:r(()=>[l("span",{"aria-hidden":"true",class:c([e.form.mailing_same_as_primary?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"])},null,2)]),_:1},8,["modelValue","class"])]),_:1})]),e.form.mailing_same_as_primary?C("",!0):(g(),A("div",te,[le,l("div",re,[s(n,{for:"mailing_address",value:"Mailing Street Address"}),s(m,{id:"mailing_address",type:"text",class:"mt-1 block w-full",modelValue:e.form.mailing_address,"onUpdate:modelValue":o[8]||(o[8]=t=>e.form.mailing_address=t),autocomplete:"address"},null,8,["modelValue"]),s(a,{message:e.form.errors.mailing_address,class:"mt-2"},null,8,["message"])]),l("div",ne,[s(n,{for:"mailing_city",value:"Mailing City"}),s(m,{id:"mailing_city",type:"text",class:"mt-1 block w-full",modelValue:e.form.mailing_city,"onUpdate:modelValue":o[9]||(o[9]=t=>e.form.mailing_city=t),autocomplete:"address-level2"},null,8,["modelValue"]),s(a,{message:e.form.errors.mailing_city,class:"mt-2"},null,8,["message"])]),l("div",ae,[s(n,{for:"mailing_state",value:"Mailing State"}),s(m,{id:"mailing_state",type:"text",class:"mt-1 block w-full",modelValue:e.form.mailing_state,"onUpdate:modelValue":o[10]||(o[10]=t=>e.form.mailing_state=t),autocomplete:"address-level1"},null,8,["modelValue"]),s(a,{message:e.form.errors.mailing_state,class:"mt-2"},null,8,["message"])]),l("div",ie,[s(n,{for:"mailing_zip",value:"Mailing Zip"}),s(m,{id:"mailing_zip",type:"text",class:"mt-1 block w-full",modelValue:e.form.mailing_zip,"onUpdate:modelValue":o[11]||(o[11]=t=>e.form.mailing_zip=t),autocomplete:"postal-code"},null,8,["modelValue"]),s(a,{message:e.form.errors.mailing_zip,class:"mt-2"},null,8,["message"])])]))])]),actions:r(()=>[s(b,{type:"submit",class:c({"opacity-25":e.form.processing||!e.form.isDirty}),disabled:e.form.processing||!e.form.isDirty},{default:r(()=>[me]),_:1},8,["class","disabled"])]),_:1},8,["onSubmitted"])}var ye=x(E,[["render",de]]);export{ye as default};
