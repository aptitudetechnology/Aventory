import{_ as y,a0 as b,a2 as v,a4 as w,a5 as x,a6 as C,aa as k,a9 as U,r as c,o as d,J as u,b as o,w as m,d as i,N as j,a as l,L as J}from"./app.fa9cc1ae.js";import{J as S}from"./FormSection.c4fa96d0.js";import{J as z}from"./ActionMessage.5ee845ce.js";const B={components:{JetActionMessage:z,JetButton:b,JetFormSection:S,JetInput:v,JetInputError:w,JetLabel:x,JetSecondaryButton:C,TextAreaInput:k,SelectBox:U},props:{product:Object},data(){return{selectedCategory:this.product.category,categories:this.$page.props.categories,form:this.$inertia.form({_method:"PATCH",name:this.product.name,description:this.product.description,category_id:this.product.category_id,type:this.product.type,scientific_name:this.product.plant?this.product.plant.scientific_name:null,common_name:this.product.plant?this.product.plant.common_name:null,zone:this.product.plant?this.product.plant.zone:null,height:this.product.plant?this.product.plant.height:null,spread:this.product.plant?this.product.plant.spread:null,bloom_color:this.product.plant?this.product.plant.bloom_color:null,fall_color:this.product.plant?this.product.plant.fall_color:null,growth_rate:this.product.plant?this.product.plant.growth_rate:null})}},watch:{selectedCategory(){this.form.category_id=this.selectedCategory.id},name(){this.form.name=this.name}},computed:{name(){return this.form.type=="plant"&&this.form.scientific_name?this.form.scientific_name+" / "+this.form.common_name:this.form.name}},methods:{updateProduct(){this.form.patch(route("products.update",this.product),{errorBag:"updateProduct",preserveScroll:!0})}}},P=i(" View and make changes to this product. "),I={class:"col-span-6"},N={key:0,class:"grid gap-4"},D={class:"col-span-3"},q={class:"col-span-3"},A={class:"col-span-3"},F={key:1},M={class:"grid gap-4"},T={class:"col-span-3"},E={class:"col-span-3"},G={class:"col-span-3"},H={class:"col-span-3"},L={class:"grid gap-4"},O=l("div",{class:"col-span-3 pt-6"},[l("h3",{class:"text-lg leading-6 font-medium text-gray-900"}," Plant details ")],-1),R={class:"grid gap-4 col-span-3 grid-cols-3"},Z={class:"col-span-3 sm:col-span-1"},K=i("Growing Zone"),Q={class:"col-span-3 sm:col-span-1"},W=i("Mature Height"),X={class:"col-span-3 sm:col-span-1"},Y=i("Mature Spread"),$={class:"col-span-3 sm:col-span-1"},ee=i("Bloom Color"),oe={class:"col-span-3 sm:col-span-1"},te=i("Fall Color"),se={class:"col-span-3 sm:col-span-1"},le=i("Growth Rate"),re=i("Save Product");function ne(me,t,p,ae,e,g){const n=c("jet-label"),a=c("jet-input"),r=c("jet-input-error"),f=c("select-box"),_=c("text-area-input"),h=c("jet-button"),V=c("jet-form-section");return d(),u("div",null,[o(V,{onSubmitted:g.updateProduct},{title:m(()=>[i(j(p.product.name),1)]),description:m(()=>[P]),form:m(()=>[l("div",I,[p.product.type!="plant"?(d(),u("div",N,[l("div",D,[o(n,{for:"name",value:"Product Name"}),o(a,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:e.form.name,"onUpdate:modelValue":t[0]||(t[0]=s=>e.form.name=s),required:"",autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.name,class:"mt-2"},null,8,["message"])]),l("div",q,[o(f,{items:e.categories,modelValue:e.selectedCategory,"onUpdate:modelValue":t[1]||(t[1]=s=>e.selectedCategory=s),selectedItem:e.selectedCategory,labelValue:"Category"},null,8,["items","modelValue","selectedItem"]),o(r,{message:e.form.errors.category_id,class:"mt-2"},null,8,["message"])]),l("div",A,[o(n,{for:"description",value:"Description"}),o(_,{id:"description",class:"mt-1 block w-full",modelValue:e.form.description,"onUpdate:modelValue":t[2]||(t[2]=s=>e.form.description=s)},null,8,["modelValue"]),o(r,{message:e.form.errors.description,class:"mt-2"},null,8,["message"])])])):(d(),u("div",F,[l("div",M,[l("div",T,[o(n,{for:"scientific_name",value:"Scientific Name"}),o(a,{id:"scientific_name",type:"text",class:"mt-1 block w-full",modelValue:e.form.scientific_name,"onUpdate:modelValue":t[3]||(t[3]=s=>e.form.scientific_name=s),required:"",autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.scientific_name,class:"mt-2"},null,8,["message"])]),l("div",E,[o(n,{for:"common_name",value:"Common Name"}),o(a,{id:"common_name",type:"text",class:"mt-1 block w-full",modelValue:e.form.common_name,"onUpdate:modelValue":t[4]||(t[4]=s=>e.form.common_name=s),required:"",autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.common_name,class:"mt-2"},null,8,["message"])]),l("div",G,[o(f,{items:e.categories,modelValue:e.selectedCategory,"onUpdate:modelValue":t[5]||(t[5]=s=>e.selectedCategory=s),selectedItem:e.selectedCategory,labelValue:"Category"},null,8,["items","modelValue","selectedItem"]),o(r,{message:e.form.errors.category_id,class:"mt-2"},null,8,["message"])]),l("div",H,[o(n,{for:"description",value:"Description"}),o(_,{id:"description",class:"mt-1 block w-full",modelValue:e.form.description,"onUpdate:modelValue":t[6]||(t[6]=s=>e.form.description=s)},null,8,["modelValue"]),o(r,{message:e.form.errors.description,class:"mt-2"},null,8,["message"])])]),l("div",L,[O,l("div",R,[l("div",Z,[o(n,{for:"zone"},{default:m(()=>[K]),_:1}),o(a,{id:"zone",type:"text",class:"mt-1 block w-full",modelValue:e.form.zone,"onUpdate:modelValue":t[7]||(t[7]=s=>e.form.zone=s),autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.zone,class:"mt-2"},null,8,["message"])]),l("div",Q,[o(n,{for:"height"},{default:m(()=>[W]),_:1}),o(a,{id:"height",type:"number",min:"0",class:"mt-1 block w-full",modelValue:e.form.height,"onUpdate:modelValue":t[8]||(t[8]=s=>e.form.height=s),autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.height,class:"mt-2"},null,8,["message"])]),l("div",X,[o(n,{for:"spread"},{default:m(()=>[Y]),_:1}),o(a,{id:"spread",type:"number",min:"0",class:"mt-1 block w-full",modelValue:e.form.spread,"onUpdate:modelValue":t[9]||(t[9]=s=>e.form.spread=s),autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.spread,class:"mt-2"},null,8,["message"])]),l("div",$,[o(n,{for:"bloom_color"},{default:m(()=>[ee]),_:1}),o(a,{id:"bloom_color",type:"text",class:"mt-1 block w-full",modelValue:e.form.bloom_color,"onUpdate:modelValue":t[10]||(t[10]=s=>e.form.bloom_color=s),autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.bloom_color,class:"mt-2"},null,8,["message"])]),l("div",oe,[o(n,{for:"fall_color"},{default:m(()=>[te]),_:1}),o(a,{id:"fall_color",type:"text",class:"mt-1 block w-full",modelValue:e.form.fall_color,"onUpdate:modelValue":t[11]||(t[11]=s=>e.form.fall_color=s),autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.fall_color,class:"mt-2"},null,8,["message"])]),l("div",se,[o(n,{for:"growth_rate"},{default:m(()=>[le]),_:1}),o(a,{id:"growth_rate",type:"text",class:"mt-1 block w-full",modelValue:e.form.growth_rate,"onUpdate:modelValue":t[12]||(t[12]=s=>e.form.growth_rate=s),autocomplete:"off"},null,8,["modelValue"]),o(r,{message:e.form.errors.growth_rate,class:"mt-2"},null,8,["message"])])])])]))])]),actions:m(()=>[o(h,{type:"submit",class:J({"opacity-25":e.form.processing||!e.form.isDirty}),disabled:e.form.processing||!e.form.isDirty},{default:m(()=>[re]),_:1},8,["class","disabled"])]),_:1},8,["onSubmitted"])])}var ue=y(B,[["render",ne]]);export{ue as default};