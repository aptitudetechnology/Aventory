import{P as y}from"./PrintButton.7e204590.js";import{J as g}from"./DialogModal.11efde9a.js";import{E as b}from"./ErrorMessage.9555be26.js";import{_ as h,r as o,o as u,J as v,b as s,w as n,c as Q,M as C,a as k,d as i}from"./app.123e766a.js";import"./Modal.c06c0ace.js";import"./XCircleIcon.401ddebd.js";const x={components:{PrintButton:y,DialogModal:g,ErrorMessage:b},props:{inventory:{type:Object,required:!0}},data(){return{confirmingQuantity:!1,quantityConfirmed:!1,form:this.$inertia.form({inventory:this.inventory.id,quantity:this.inventory.quantity})}},methods:{sendToQueue(){this.form.post(route("reprint-queue.store"),{onSuccess:()=>{this.confirmingQuantity=!1}})},confirmQuantity(){this.inventory.quantity>1?this.confirmingQuantity=!0:this.sendToQueue()}}},q={class:"pt-4 flex flex-col items-center"},j=i(" How many tags would you like to print? "),w={class:"flex items-center justify-between"},M=i("Cancel"),V=i("Send to Queue"),E=i("Send Inventory to Print Queue");function B(T,e,l,D,t,a){const c=o("jet-input"),m=o("jet-secondary-button"),f=o("jet-button"),d=o("DialogModal"),_=o("print-button"),p=o("ErrorMessage");return u(),v("div",q,[s(d,{onClose:e[2]||(e[2]=r=>t.confirmingQuantity=!1),show:t.confirmingQuantity},{title:n(()=>[j]),content:n(()=>[s(c,{class:"w-full",min:1,max:l.inventory.quantity,type:"number",modelValue:t.form.quantity,"onUpdate:modelValue":e[0]||(e[0]=r=>t.form.quantity=r)},null,8,["max","modelValue"])]),footer:n(()=>[k("div",w,[s(m,{onClick:e[1]||(e[1]=r=>t.confirmingQuantity=!1),class:"mr-4 ml-0"},{default:n(()=>[M]),_:1}),s(f,{type:"submit",onClick:a.sendToQueue},{default:n(()=>[V]),_:1},8,["onClick"])])]),_:1},8,["show"]),s(_,{disabled:t.form.processing,onClick:a.confirmQuantity,type:"button"},{default:n(()=>[E]),_:1},8,["disabled","onClick"]),t.form.hasErrors?(u(),Q(p,{key:0,class:"mt-4"})):C("",!0)])}var O=h(x,[["render",B]]);export{O as default};
