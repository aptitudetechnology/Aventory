import{P as y}from"./PrintButton.b0ecd104.js";import{J as g}from"./DialogModal.15f17e82.js";import{E as b}from"./ErrorMessage.84bde280.js";import{_ as h}from"./plugin-vue_export-helper.21dcd24c.js";import{r as o,o as u,t as v,b as i,w as n,c as Q,v as C,a as k,d as s}from"./app.c6d51eb6.js";import"./Modal.a8ddeb0e.js";import"./SectionTitle.6e9e4bb1.js";import"./XCircleIcon.7dffa179.js";const x={components:{PrintButton:y,DialogModal:g,ErrorMessage:b},props:{inventory:{type:Object,required:!0}},data(){return{confirmingQuantity:!1,quantityConfirmed:!1,form:this.$inertia.form({inventory:this.inventory.id,quantity:this.inventory.quantity})}},methods:{sendToQueue(){this.form.post(route("reprint-queue.store"),{onSuccess:()=>{this.confirmingQuantity=!1}})},confirmQuantity(){this.inventory.quantity>1?this.confirmingQuantity=!0:this.sendToQueue()}}},q={class:"pt-4 flex flex-col items-center"},j=s(" How many tags would you like to print? "),w={class:"flex items-center justify-between"},M=s("Cancel"),V=s("Send to Queue"),E=s("Send Inventory to Print Queue");function B(T,e,m,D,t,a){const l=o("jet-input"),c=o("jet-secondary-button"),f=o("jet-button"),d=o("DialogModal"),p=o("print-button"),_=o("ErrorMessage");return u(),v("div",q,[i(d,{onClose:e[2]||(e[2]=r=>t.confirmingQuantity=!1),show:t.confirmingQuantity},{title:n(()=>[j]),content:n(()=>[i(l,{class:"w-full",min:1,max:m.inventory.quantity,type:"number",modelValue:t.form.quantity,"onUpdate:modelValue":e[0]||(e[0]=r=>t.form.quantity=r)},null,8,["max","modelValue"])]),footer:n(()=>[k("div",w,[i(c,{onClick:e[1]||(e[1]=r=>t.confirmingQuantity=!1),class:"mr-4 ml-0"},{default:n(()=>[M]),_:1}),i(f,{type:"submit",onClick:a.sendToQueue},{default:n(()=>[V]),_:1},8,["onClick"])])]),_:1},8,["show"]),i(p,{disabled:t.form.processing,onClick:a.confirmQuantity,type:"button"},{default:n(()=>[E]),_:1},8,["disabled","onClick"]),t.form.hasErrors?(u(),Q(_,{key:0,class:"mt-4"})):C("",!0)])}var U=h(x,[["render",B]]);export{U as default};
