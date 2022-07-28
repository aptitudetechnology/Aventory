import{_ as y,a0 as V,a2 as b,a4 as w,a5 as k,a6 as j,aa as U,r as m,o as d,J as _,a as l,N as f,M as J,b as t,w as i,O as N,a8 as S,L as D,d as u}from"./app.9dc34ef4.js";import{J as B}from"./DialogModal.13bcfa5f.js";import{J as P}from"./ActionMessage.59b94243.js";import M from"./DeleteContactComponent.de3acbd1.js";import"./Modal.c8b704a0.js";import"./ActionSection.8b02576e.js";import"./ConfirmationModal.47b3bac6.js";const A={components:{JetActionMessage:P,JetButton:V,JetDialogModal:B,JetInput:b,JetInputError:w,JetLabel:k,JetSecondaryButton:j,TextAreaInput:U,DeleteContactComponent:M},props:{contact:Object},data(){return{updatingContact:!1,form:this.$inertia.form({_method:"PUT",first_name:this.contact.first_name,last_name:this.contact.last_name,notes:this.contact.notes,email:this.contact.email,phone_1:this.contact.phone_1,phone_2:this.contact.phone_2,cell_phone:this.contact.cell_phone,fax:this.contact.fax})}},computed:{name(){return this.contact.last_name?this.contact.first_name+" "+this.contact.last_name:this.contact.first_name}},methods:{updateContact(){this.form.put(route("contacts.update",{contact:this.contact}),{preserveScroll:!1,preserveState:!0,onSuccess:()=>{this.form.reset(),this.updatingContact=!1}})}}},E={class:"flex-1 min-w-0"},I={class:"focus:outline-none"},L=l("span",{class:"absolute inset-0","aria-hidden":"true"},null,-1),T={class:"text-sm text-gray-900"},F={key:0,class:"text-sm text-gray-500 truncate"},K=u("Update Contact"),O={class:"col-span-6"},q={class:"grid gap-4"},z={class:"col-span-4 sm:col-span-2"},G={class:"col-span-4 sm:col-span-2"},H={class:"col-span-4"},Q={class:"grid gap-4"},R=l("div",{class:"col-span-4 pt-6"},[l("h3",{class:"text-lg leading-6 font-medium text-gray-900"}," Contact Details ")],-1),W={class:"col-span-4"},X={class:"col-span-4 sm:col-span-2"},Y={class:"col-span-4 sm:col-span-2"},Z={class:"col-span-4 sm:col-span-2"},$={class:"col-span-4 sm:col-span-2"},ee={class:"flex justify-between w-full"},te=u("Cancel"),oe=u("Save Contact");function se(le,o,p,ne,e,r){const h=m("delete-contact-component"),n=m("jet-label"),c=m("jet-input"),a=m("jet-input-error"),g=m("text-area-input"),v=m("jet-secondary-button"),C=m("jet-button"),x=m("jet-dialog-modal");return d(),_("div",null,[l("div",{onClick:o[0]||(o[0]=s=>e.updatingContact=!0),class:"relative py-5 px-4 sm:px-6 flex items-center space-x-3 hover:bg-gray-50 cursor-pointer"},[l("div",E,[l("div",I,[L,l("p",T,f(r.name),1),p.contact.phone_1?(d(),_("p",F,f(p.contact.phone_1),1)):J("",!0)])])]),t(x,{show:e.updatingContact,onClose:o[12]||(o[12]=s=>e.updatingContact=!1)},{title:i(()=>[K]),aside:i(()=>[t(h,{contact:p.contact},null,8,["contact"])]),content:i(()=>[l("form",{onSubmit:o[9]||(o[9]=N((...s)=>r.updateContact&&r.updateContact(...s),["prevent"])),onKeyup:o[10]||(o[10]=S((...s)=>r.updateContact&&r.updateContact(...s),["enter"]))},[l("div",O,[l("div",q,[l("div",z,[t(n,{for:"first_name",value:"First Name"}),t(c,{id:"first_name",type:"text",class:"mt-1 block w-full",modelValue:e.form.first_name,"onUpdate:modelValue":o[1]||(o[1]=s=>e.form.first_name=s),required:"",autocomplete:"given-name"},null,8,["modelValue"]),t(a,{message:e.form.errors.first_name,class:"mt-2"},null,8,["message"])]),l("div",G,[t(n,{for:"last_name",value:"Last Name"}),t(c,{id:"last_name",type:"text",class:"mt-1 block w-full",modelValue:e.form.last_name,"onUpdate:modelValue":o[2]||(o[2]=s=>e.form.last_name=s),autocomplete:"family-name"},null,8,["modelValue"]),t(a,{message:e.form.errors.last_name,class:"mt-2"},null,8,["message"])]),l("div",H,[t(n,{for:"notes",value:"Contact Notes"}),t(g,{id:"notes",class:"mt-1 block w-full",modelValue:e.form.notes,"onUpdate:modelValue":o[3]||(o[3]=s=>e.form.notes=s)},null,8,["modelValue"]),t(a,{message:e.form.errors.notes,class:"mt-2"},null,8,["message"])])]),l("div",Q,[R,l("div",W,[t(n,{for:"email",value:"Email Address"}),t(c,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e.form.email,"onUpdate:modelValue":o[4]||(o[4]=s=>e.form.email=s),autocomplete:"email"},null,8,["modelValue"]),t(a,{message:e.form.errors.email,class:"mt-2"},null,8,["message"])]),l("div",X,[t(n,{for:"phone_1",value:"Primary Phone"}),t(c,{id:"phone_1",type:"tel",class:"mt-1 block w-full",modelValue:e.form.phone_1,"onUpdate:modelValue":o[5]||(o[5]=s=>e.form.phone_1=s),autocomplete:"tel"},null,8,["modelValue"]),t(a,{message:e.form.errors.phone_1,class:"mt-2"},null,8,["message"])]),l("div",Y,[t(n,{for:"phone_2",value:"Secondary Phone"}),t(c,{id:"phone_2",type:"tel",class:"mt-1 block w-full",modelValue:e.form.phone_2,"onUpdate:modelValue":o[6]||(o[6]=s=>e.form.phone_2=s),autocomplete:"tel"},null,8,["modelValue"]),t(a,{message:e.form.errors.phone_2,class:"mt-2"},null,8,["message"])]),l("div",Z,[t(n,{for:"cell_phone",value:"Cell Phone"}),t(c,{id:"cell_phone",type:"tel",class:"mt-1 block w-full",modelValue:e.form.cell_phone,"onUpdate:modelValue":o[7]||(o[7]=s=>e.form.cell_phone=s),autocomplete:"tel"},null,8,["modelValue"]),t(a,{message:e.form.errors.cell_phone,class:"mt-2"},null,8,["message"])]),l("div",$,[t(n,{for:"fax",value:"Fax"}),t(c,{id:"fax",type:"tel",class:"mt-1 block w-full",modelValue:e.form.fax,"onUpdate:modelValue":o[8]||(o[8]=s=>e.form.fax=s),autocomplete:"tel"},null,8,["modelValue"]),t(a,{message:e.form.errors.fax,class:"mt-2"},null,8,["message"])])])])],32)]),footer:i(()=>[l("div",ee,[t(v,{type:"button",onClick:o[11]||(o[11]=s=>e.updatingContact=!1)},{default:i(()=>[te]),_:1}),t(C,{type:"submit",onClick:r.updateContact,class:D({"opacity-25":e.form.processing||!e.form.isDirty}),disabled:e.form.processing||!e.form.isDirty},{default:i(()=>[oe]),_:1},8,["onClick","class","disabled"])])]),_:1},8,["show"])])}var de=y(A,[["render",se]]);export{de as default};
