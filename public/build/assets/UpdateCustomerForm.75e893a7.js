import{_ as z,a0 as L,a2 as T,a4 as D,a5 as J,a6 as R,aa as M,a9 as I,r as n,o as b,c as V,w as a,d,N as y,a as o,b as s,L as m,Q as f,U as x,M as N}from"./app.123e766a.js";import{J as A}from"./FormSection.a31e0947.js";import{J as B}from"./ActionMessage.df590980.js";import{S as P,a as G,b as E,c as F}from"./switch.esm.cc9d415a.js";import"./description.esm.8bb4746d.js";import"./label.esm.25c1a873.js";const Z={components:{JetActionMessage:B,JetButton:L,JetFormSection:A,JetInput:T,JetInputError:D,JetLabel:J,JetSecondaryButton:R,Switch:P,SwitchDescription:G,SwitchGroup:E,SwitchLabel:F,TextAreaInput:M,SelectBox:I},props:["customer"],data(){return{priceLevels:this.$page.props.priceLevels,price_level:this.$page.props.priceLevel,updatedCustomer:this.$inertia.form(this.customer)}},computed:{hasCustomTaxRate:{get(){return this.updatedCustomer.tax_percentage!==null},set(C){this.updatedCustomer.tax_percentage=C==!0?8:null}}},watch:{price_level:function(){this.price_level?this.updatedCustomer.customer_price_level_id=this.price_level.id:this.updatedCustomer.customer_price_level_id=null}},methods:{updateCustomer(){this.updatedCustomer.patch(route("customers.update",this.customer.id),{preserveScroll:!1,preserveState:!0})}}},q={class:"col-span-6"},Q={class:"grid gap-4"},H={class:"col-span-3"},K={class:"col-span-3"},O={class:"grid gap-4"},W=o("div",{class:"col-span-3 pt-6"},[o("h3",{class:"text-lg leading-6 text-gray-900"}," Primary Address ")],-1),X={class:"col-span-3"},Y={class:"col-span-3 md:col-span-1"},$={class:"col-span-3 md:col-span-1"},ee={class:"col-span-3 md:col-span-1"},se={class:"flex-grow flex flex-col mr-4"},te=d("Mailing same as primary"),le=d("Indicate whether the mailing address of this customer is the same as the primary address."),oe={class:"grid gap-4"},ae=o("div",{class:"col-span-3 pt-6"},[o("h3",{class:"text-lg leading-6 text-gray-900"}," Mailing Address ")],-1),re={class:"col-span-3"},ie={class:"col-span-3 md:col-span-1"},ne={class:"col-span-3 md:col-span-1"},ue={class:"col-span-3 md:col-span-1"},de={class:"grid gap-4"},me=o("div",{class:"col-span-3 pt-6"},[o("h3",{class:"text-lg leading-6 text-gray-900"}," Customer Details ")],-1),pe={class:"grid gap-4 col-span-3"},ce=d("Taxable?"),_e={class:"grid gap-4 sm:gap-6 sm:grid-cols-3 col-span-3"},ge={class:"flex flex-col"},fe=d("Custom Tax Rate?"),xe=d("Indicate whether this customer has a custom tax rate to be applied to taxable orders and products."),Ce={class:"grid gap-4 sm:grid-cols-2 col-span-3"},ve={class:""},he={class:""},be=d("Save Customer");function Ve(C,t,v,ye,e,p){const i=n("jet-label"),u=n("jet-input"),r=n("jet-input-error"),w=n("text-area-input"),c=n("SwitchLabel"),S=n("SwitchDescription"),_=n("Switch"),g=n("SwitchGroup"),k=n("select-box"),h=n("percentage-input"),U=n("jet-button"),j=n("jet-form-section");return b(),V(j,{onSubmitted:p.updateCustomer},{title:a(()=>[d(y(v.customer.name),1)]),description:a(()=>[d(" Update "+y(v.customer.name)+" by editing the form fields and clicking save. ",1)]),form:a(()=>[o("div",q,[o("div",Q,[o("div",H,[s(i,{for:"name",value:"Customer Name"}),s(u,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.name,"onUpdate:modelValue":t[0]||(t[0]=l=>e.updatedCustomer.name=l),required:"",autocomplete:"organization"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.name,class:"mt-2"},null,8,["message"])]),o("div",K,[s(i,{for:"notes",value:"Customer Notes"}),s(w,{id:"notes",class:"mt-1 block w-full",modelValue:e.updatedCustomer.notes,"onUpdate:modelValue":t[1]||(t[1]=l=>e.updatedCustomer.notes=l)},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.notes,class:"mt-2"},null,8,["message"])])]),o("div",O,[W,o("div",X,[s(i,{for:"address",value:"Street Address"}),s(u,{id:"address",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.address,"onUpdate:modelValue":t[2]||(t[2]=l=>e.updatedCustomer.address=l),autocomplete:"address"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.address,class:"mt-2"},null,8,["message"])]),o("div",Y,[s(i,{for:"city",value:"City"}),s(u,{id:"city",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.city,"onUpdate:modelValue":t[3]||(t[3]=l=>e.updatedCustomer.city=l),autocomplete:"address-level2"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.city,class:"mt-2"},null,8,["message"])]),o("div",$,[s(i,{for:"state",value:"State"}),s(u,{id:"state",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.state,"onUpdate:modelValue":t[4]||(t[4]=l=>e.updatedCustomer.state=l),autocomplete:"address-level1"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.state,class:"mt-2"},null,8,["message"])]),o("div",ee,[s(i,{for:"zip",value:"Zip"}),s(u,{id:"zip",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.zip,"onUpdate:modelValue":t[5]||(t[5]=l=>e.updatedCustomer.zip=l),autocomplete:"postal-code"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.zip,class:"mt-2"},null,8,["message"])]),s(g,{as:"div",class:"flex items-center justify-between col-span-3"},{default:a(()=>[o("span",se,[s(c,{as:"span",class:"text-sm text-gray-900"},{default:a(()=>[te]),_:1}),s(S,{as:"span",class:"text-sm text-gray-500"},{default:a(()=>[le]),_:1})]),s(_,{modelValue:e.updatedCustomer.mailing_same_as_primary,"onUpdate:modelValue":t[6]||(t[6]=l=>e.updatedCustomer.mailing_same_as_primary=l),class:m([e.updatedCustomer.mailing_same_as_primary?"bg-green-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"])},{default:a(()=>[o("span",{"aria-hidden":"true",class:m([e.updatedCustomer.mailing_same_as_primary?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transupdatedCustomer ring-0 transition ease-in-out duration-200"])},null,2)]),_:1},8,["modelValue","class"])]),_:1})]),f(o("div",oe,[ae,o("div",re,[s(i,{for:"mailing_address",value:"Mailing Street Address"}),s(u,{id:"mailing_address",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.mailing_address,"onUpdate:modelValue":t[7]||(t[7]=l=>e.updatedCustomer.mailing_address=l),autocomplete:"address"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.mailing_address,class:"mt-2"},null,8,["message"])]),o("div",ie,[s(i,{for:"mailing_city",value:"Mailing City"}),s(u,{id:"mailing_city",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.mailing_city,"onUpdate:modelValue":t[8]||(t[8]=l=>e.updatedCustomer.mailing_city=l),autocomplete:"address-level2"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.mailing_city,class:"mt-2"},null,8,["message"])]),o("div",ne,[s(i,{for:"mailing_state",value:"Mailing State"}),s(u,{id:"mailing_state",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.mailing_state,"onUpdate:modelValue":t[9]||(t[9]=l=>e.updatedCustomer.mailing_state=l),autocomplete:"address-level1"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.mailing_state,class:"mt-2"},null,8,["message"])]),o("div",ue,[s(i,{for:"mailing_zip",value:"Mailing Zip"}),s(u,{id:"mailing_zip",type:"text",class:"mt-1 block w-full",modelValue:e.updatedCustomer.mailing_zip,"onUpdate:modelValue":t[10]||(t[10]=l=>e.updatedCustomer.mailing_zip=l),autocomplete:"postal-code"},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.mailing_zip,class:"mt-2"},null,8,["message"])])],512),[[x,!e.updatedCustomer.mailing_same_as_primary]]),o("div",de,[me,o("div",pe,[e.priceLevels.length>0?(b(),V(k,{key:0,items:e.priceLevels,selectedItem:e.price_level,modelValue:e.price_level,"onUpdate:modelValue":t[11]||(t[11]=l=>e.price_level=l),labelValue:"Customer Price Level"},null,8,["items","selectedItem","modelValue"])):N("",!0),s(r,{message:e.updatedCustomer.errors.customer_price_level_id,class:"mt-2"},null,8,["message"]),s(g,{as:"div",class:"flex items-center justify-start col-span-3 sm:col-span-1"},{default:a(()=>[s(c,{as:"span",class:"text-sm text-gray-900 mr-4"},{default:a(()=>[ce]),_:1}),s(_,{modelValue:e.updatedCustomer.is_taxable,"onUpdate:modelValue":t[12]||(t[12]=l=>e.updatedCustomer.is_taxable=l),class:m([e.updatedCustomer.is_taxable?"bg-green-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"])},{default:a(()=>[o("span",{"aria-hidden":"true",class:m([e.updatedCustomer.is_taxable?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transupdatedCustomer ring-0 transition ease-in-out duration-200"])},null,2)]),_:1},8,["modelValue","class"])]),_:1}),o("div",_e,[f(s(g,{as:"div",class:"flex items-center justify-start sm:col-span-2"},{default:a(()=>[o("div",ge,[s(c,{as:"span",class:"text-sm font-medium text-gray-900 mr-4"},{default:a(()=>[fe]),_:1}),s(c,{as:"span",class:"text-sm text-gray-500"},{default:a(()=>[xe]),_:1})]),s(_,{modelValue:p.hasCustomTaxRate,"onUpdate:modelValue":t[13]||(t[13]=l=>p.hasCustomTaxRate=l),class:m([p.hasCustomTaxRate?"bg-green-600":"bg-gray-200","relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"])},{default:a(()=>[o("span",{"aria-hidden":"true",class:m([p.hasCustomTaxRate?"translate-x-5":"translate-x-0","pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transupdatedCustomer ring-0 transition ease-in-out duration-200"])},null,2)]),_:1},8,["modelValue","class"])]),_:1},512),[[x,e.updatedCustomer.is_taxable]]),f(o("div",null,[s(i,{for:"tax_percentage",value:"Customer Tax Rate"}),s(h,{id:"tax_percentage",max:"100.00",min:"0.00",step:".01",placeholder:"0.00",modelValue:e.updatedCustomer.tax_percentage,"onUpdate:modelValue":t[14]||(t[14]=l=>e.updatedCustomer.tax_percentage=l)},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.tax_percentage,class:"mt-2"},null,8,["message"])],512),[[x,p.hasCustomTaxRate]])])]),o("div",Ce,[o("div",ve,[s(i,{for:"discount_percentage",value:"Percentage Discount"}),s(h,{id:"discount_percentage",max:"100.00",min:"0.00",placeholder:"0.00",modelValue:e.updatedCustomer.discount_percentage,"onUpdate:modelValue":t[15]||(t[15]=l=>e.updatedCustomer.discount_percentage=l)},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.discount_percentage,class:"mt-2"},null,8,["message"])]),o("div",he,[s(i,{for:"reseller_permit_expiration",value:"Reseller Permit Expiration"}),s(u,{id:"reseller_permit_expiration",type:"date",class:"mt-1 block w-full",modelValue:e.updatedCustomer.reseller_permit_expiration,"onUpdate:modelValue":t[16]||(t[16]=l=>e.updatedCustomer.reseller_permit_expiration=l)},null,8,["modelValue"]),s(r,{message:e.updatedCustomer.errors.reseller_permit_expiration,class:"mt-2"},null,8,["message"])])])])])]),actions:a(()=>[s(U,{type:"submit",class:m([{"opacity-25":e.updatedCustomer.processing},{"opacity-25":!e.updatedCustomer.isDirty}]),disabled:e.updatedCustomer.processing||!e.updatedCustomer.isDirty},{default:a(()=>[be]),_:1},8,["class","disabled"])]),_:1},8,["onSubmitted"])}var Le=z(Z,[["render",Ve]]);export{Le as default};
