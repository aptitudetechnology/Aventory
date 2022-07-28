import{J as V}from"./DialogModal.15f17e82.js";import{r as i,o as j,t as x,b as n,w as s,d as c,x as C,a as r,y as k,I as S,A as p,B as _,u as P}from"./app.c6d51eb6.js";import{r as B}from"./PlusIcon.1e874ef7.js";import{_ as I}from"./plugin-vue_export-helper.21dcd24c.js";import"./Modal.a8ddeb0e.js";import"./SectionTitle.6e9e4bb1.js";const N={props:{order:Object},components:{JetDialogModal:V,PlusIcon:B},data(){return{creatingDiscount:!1,discount:this.$inertia.form({_method:"POST",description:null,discount_percentage:null,discount_amount:null,is_percentage:!1})}},watch:{"discount.is_percentage":function(d){d?this.discount.discount_amount=null:this.discount.discount_percentage=null}},methods:{createDiscount(){this.discount.post(route("sales.discounts.store",this.order),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{this.$emit("discount-created",this.discount),this.creatingDiscount=!1,this.discount.reset()}})}}},U=c("New Discount"),A={class:"grid grid-cols-6 gap-4"},O={class:"grid gap-2 col-span-3"},J=c("Discount Description"),K={class:"grid gap-2 col-span-2"},M=c("Percentage Discount?"),T=c("Percentage"),q={class:"grid gap-2"},z=c("Percentage %"),E={class:"grid gap-2"},W=c("Discount Amount"),F={class:"flex justify-between items-center w-full"},G=c("Cancel"),H=c("Save Discount");function L(d,e,m,Q,t,u){const g=i("PlusIcon"),a=i("jet-button"),l=i("jet-label"),f=i("text-area-input"),D=i("jet-input-error"),h=i("jet-checkbox"),v=i("percentage-input"),b=i("money-input"),w=i("jet-secondary-button"),y=i("jet-dialog-modal");return j(),x("div",null,[n(a,{type:"button",class:"btn-warning",onClick:e[0]||(e[0]=o=>t.creatingDiscount=!0)},{default:s(()=>[n(g,{class:"w-4 h-4 mr-2"}),U]),_:1}),n(y,{maxWidth:"3xl",show:t.creatingDiscount,onClose:e[8]||(e[8]=o=>t.creatingDiscount=!1)},{title:s(()=>[c("Add a discount to apply to this "+C(m.order.type)+".",1)]),content:s(()=>[r("div",A,[r("form",{onSubmit:e[5]||(e[5]=k((...o)=>u.createDiscount&&u.createDiscount(...o),["prevent"])),onKeydown:e[6]||(e[6]=S((...o)=>u.createDiscount&&u.createDiscount(...o),["enter"])),class:"col-span-6 grid gap-4 grid-cols-5 items-start"},[r("div",O,[n(l,{for:"description"},{default:s(()=>[J]),_:1}),n(f,{required:"",modelValue:t.discount.description,"onUpdate:modelValue":e[1]||(e[1]=o=>t.discount.description=o),id:"description"},null,8,["modelValue"]),n(D,{message:t.discount.errors.description},null,8,["message"])]),r("div",K,[n(l,null,{default:s(()=>[M,n(h,{modelValue:t.discount.is_percentage,"onUpdate:modelValue":e[2]||(e[2]=o=>t.discount.is_percentage=o),class:"ml-2"},{default:s(()=>[T]),_:1},8,["modelValue"])]),_:1}),p(r("div",q,[n(l,{for:"percentage"},{default:s(()=>[z]),_:1}),n(v,{id:"percentage",modelValue:t.discount.discount_percentage,"onUpdate:modelValue":e[3]||(e[3]=o=>t.discount.discount_percentage=o)},null,8,["modelValue"])],512),[[_,t.discount.is_percentage]]),p(r("div",E,[n(l,{for:"amount"},{default:s(()=>[W]),_:1}),n(b,{id:"amount",modelValue:t.discount.discount_amount,"onUpdate:modelValue":e[4]||(e[4]=o=>t.discount.discount_amount=o)},null,8,["modelValue"])],512),[[_,!t.discount.is_percentage]])])],32)])]),footer:s(()=>[r("div",F,[n(w,{type:"button",onClick:e[7]||(e[7]=o=>t.creatingDiscount=!1)},{default:s(()=>[G]),_:1}),r("div",null,[n(a,{type:"submit",onClick:u.createDiscount,class:P({"opacity-25":t.discount.processing}),disabled:t.discount.processing},{default:s(()=>[H]),_:1},8,["onClick","class","disabled"])])])]),_:1},8,["show"])])}var te=I(N,[["render",L]]);export{te as default};
