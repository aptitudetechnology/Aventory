import{J as l}from"./ConfirmationModal.47b3bac6.js";import{_,r as a,o as y,c as h,w as t,d as n,N as s,b as c}from"./app.9dc34ef4.js";import"./Modal.c8b704a0.js";const p={components:{JetConfirmationModal:l},props:{selectedProduct:{type:Object,required:!1},quantity:{type:Number,required:!1},quantityAvailable:{type:Number,required:!1},show:{type:Boolean,required:!0}},data(){return{confirmingQuantity:this.show}},watch:{show(){this.confirmingQuantity=this.show}},emits:["quantity-confirmed"],methods:{confirmed(){this.confirmingQuantity=!1,this.$emit("quantity-confirmed")}}},b=n(" Confirm Quantity "),q=n(" Nevermind Edit "),w=n(" Yes, Confirm ");function C(v,e,i,Q,r,m){const u=a("jet-secondary-button"),f=a("jet-button"),d=a("jet-confirmation-modal");return y(),h(d,{show:r.confirmingQuantity,onClose:e[1]||(e[1]=o=>r.confirmingQuantity=!1)},{title:t(()=>[b]),content:t(()=>{var o;return[n(" The amount of "+s((o=i.selectedProduct)==null?void 0:o.name)+" available for sale is: "+s(i.quantityAvailable)+". Are you sure you want to add "+s(i.quantity)+" to this order? ",1)]}),footer:t(()=>[c(u,{onClick:e[0]||(e[0]=o=>r.confirmingQuantity=!1)},{default:t(()=>[q]),_:1}),c(f,{class:"ml-2",onClick:m.confirmed},{default:t(()=>[w]),_:1},8,["onClick"])]),_:1},8,["show"])}var k=_(p,[["render",C]]);export{k as default};