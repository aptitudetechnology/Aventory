import{C as x}from"./CheckIcon.bea586b0.js";import{_ as y,a3 as g,a5 as I,r as c,o as n,J as l,a as i,b as t,w as p,N as r,d as _}from"./app.123e766a.js";import b from"./EditPurchaseItem.f1e194e7.js";import C from"./DeletePurchaseItem.a0026c89.js";import V from"./RemoveItemFromInventory.89182b2a.js";import"./DialogModal.11efde9a.js";import"./Modal.c06c0ace.js";import"./ActionMessage.df590980.js";import"./EditButton.06de44cf.js";import"./PencilIcon.8d9e916b.js";import"./switch.esm.cc9d415a.js";import"./description.esm.8bb4746d.js";import"./label.esm.25c1a873.js";import"./ConfirmationModal.82dd7e96.js";import"./DeleteButton.6111e10e.js";import"./TrashIcon.22389a9d.js";const P={components:{Check:x,JetCheckBox:g,JetLabel:I,EditPurchaseItem:b,DeletePurchaseItem:C,RemoveItemFromInventory:V},props:{item:Object,itemSelected:Boolean},data(){return{selected:this.itemSelected,form:this.$inertia.form(this.item)}},watch:{itemSelected(){this.selected=this.itemSelected}},methods:{itemReceived(){this.form.patch(route("purchase-item.update",this.item))}}},S={class:"grid gap-4 grid-cols-5 md:grid-cols-10 py-2 items-center"},w={class:"col-span-2 md:col-span-4 flex items-center"},R=_("Select"),j={title:"Product Name",class:"ml-6 truncate"},B={class:"px-1 text-sm text-gray-500 tracking-wider uppercase",title:"Product Size"},N={class:"px-1 text-sm text-gray-500 tracking-wider uppercase",title:"Quantity Confirmed"},D={class:"px-1 hidden md:block text-sm text-gray-500 tracking-wider uppercase",title:"Unit Price"},E={class:"px-1 hidden md:block"},F=_("Item Received"),J={class:"px-1 hidden md:block"},U={key:0},z={key:1,class:"flex"};function L(h,o,s,q,e,u){const a=c("jet-label"),d=c("jet-check-box"),f=c("RemoveItemFromInventory"),v=c("DeletePurchaseItem"),k=c("edit-purchase-item");return n(),l("div",S,[i("div",w,[t(a,{class:"sr-only",for:"item-selected"+e.form.id},{default:p(()=>[R]),_:1},8,["for"]),t(d,{id:"item-selected"+e.form.id,onChange:o[0]||(o[0]=m=>h.$emit("selected")),value:e.form.id,modelValue:e.selected,"onUpdate:modelValue":o[1]||(o[1]=m=>e.selected=m),checked:e.selected},null,8,["id","value","modelValue","checked"]),i("div",j,r(e.form.product.name),1)]),i("div",B,r(e.form.size.name),1),i("div",N,r(e.form.quantity_confirmed),1),i("div",D," $ "+r(e.form.unit_price),1),i("div",E,[t(a,{class:"sr-only",for:"item-recieved"+e.form.id},{default:p(()=>[F]),_:1},8,["for"]),t(d,{id:"item-recieved"+e.form.id,onChange:u.itemReceived,modelValue:e.form.received,"onUpdate:modelValue":o[2]||(o[2]=m=>e.form.received=m),disabled:s.item.in_inventory,color:"gray",checked:e.form.received},null,8,["id","onChange","modelValue","disabled","checked"])]),i("div",J,[t(d,{disabled:!0,checked:s.item.printed},null,8,["checked"])]),s.item.in_inventory?(n(),l("div",U,[t(f,{item:s.item},null,8,["item"])])):(n(),l("div",z,[t(v,{item:s.item},null,8,["item"]),t(k,{title:"Edit",purchaseItem:s.item},null,8,["purchaseItem"])]))])}var oe=y(P,[["render",L]]);export{oe as default};
