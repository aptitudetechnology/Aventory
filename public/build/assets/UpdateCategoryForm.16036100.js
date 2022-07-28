import{J as g}from"./Button.9edbaae6.js";import{J as y}from"./FormSection.532e715f.js";import{J as h}from"./Input.3e59ac9d.js";import{J as b}from"./InputError.871a3d35.js";import{J}from"./Label.98bc58ad.js";import{J as v}from"./ActionMessage.beea7ba5.js";import{J as j}from"./SecondaryButton.d03b45d1.js";import{T as C}from"./TextAreaInput.8e8fc994.js";import{_ as x}from"./plugin-vue_export-helper.21dcd24c.js";import{r as o,o as V,c as S,w as r,d as i,x as B,a,b as t,u as w}from"./app.c6d51eb6.js";import"./SectionTitle.6e9e4bb1.js";const k={components:{JetActionMessage:v,JetButton:g,JetFormSection:y,JetInput:h,JetInputError:b,JetLabel:J,JetSecondaryButton:j,TextAreaInput:C},props:{category:Object},data(){return{form:this.$inertia.form({_method:"PATCH",name:this.category.name,description:this.category.description})}},methods:{updateCategory(){this.form.patch(route("categories.update",this.category),{errorBag:"updateCategory",preserveScroll:!0,preserveState:!1})}}},N=i(" Update this category. Products in this category will have the changes reflected immediately. "),T={class:"col-span-6"},U={class:"grid gap-4"},A={class:"col-span-3"},D={class:"col-span-3"},I=i("Save Category");function F(P,s,l,q,e,p){const m=o("jet-label"),d=o("jet-input"),c=o("jet-input-error"),u=o("text-area-input"),_=o("jet-button"),f=o("jet-form-section");return V(),S(f,{onSubmitted:p.updateCategory},{title:r(()=>[i(B(l.category.name),1)]),description:r(()=>[N]),form:r(()=>[a("div",T,[a("div",U,[a("div",A,[t(m,{for:"name",value:"Category Name"}),t(d,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:e.form.name,"onUpdate:modelValue":s[0]||(s[0]=n=>e.form.name=n),required:"",autocomplete:"off"},null,8,["modelValue"]),t(c,{message:e.form.errors.name,class:"mt-2"},null,8,["message"])]),a("div",D,[t(m,{for:"description",value:"Category description"}),t(u,{id:"description",class:"mt-1 block w-full",modelValue:e.form.description,"onUpdate:modelValue":s[1]||(s[1]=n=>e.form.description=n)},null,8,["modelValue"]),t(c,{message:e.form.errors.description,class:"mt-2"},null,8,["message"])])])])]),actions:r(()=>[t(_,{type:"submit",class:w({"opacity-25":e.form.processing||!e.form.isDirty}),disabled:e.form.processing||!e.form.isDirty},{default:r(()=>[I]),_:1},8,["class","disabled"])]),_:1},8,["onSubmitted"])}var X=x(k,[["render",F]]);export{X as default};
