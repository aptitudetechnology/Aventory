import{J as j}from"./DialogModal.13bcfa5f.js";import{J as k}from"./ConfirmationModal.47b3bac6.js";import{_ as x,r as l,o as u,J as f,d as i,N as a,b as o,w as t,c as y,M as h,a as s,L as w,a8 as D,O as Q}from"./app.9dc34ef4.js";import"./Modal.c8b704a0.js";const V={props:{archivedItem:Object,order:Object,quantity_left:Number},components:{DialogModal:j,ConfirmationModal:k},data(){return{editingItem:!1,confirmingDeletion:!1,confirm_quantity:!1,item:this.$inertia.form(this.archivedItem)}},computed:{needToConfirmQuantity(){return this.quantityToAdd>this.quantity_left},orderItemQuantity(){return this.archivedItem.order_item_quantity},quantityToAdd(){return parseInt(this.item.quantity_removed)-parseInt(this.archivedItem.quantity_removed)},orderItemQuantityAfterAdding(){return parseInt(this.orderItemQuantity)+parseInt(this.quantityToAdd)},itemIsGroup(){return this.archivedItem.inventory_is_group}},methods:{confirmDeletion(){this.confirmingDeletion=!0},deleteItem(){this.item.delete(route("inventory-archive.destroy",{inventory_archive:this.archivedItem.id}),{preserveState:!1})},updateItem(){console.log(this.item),this.item.patch(route("inventory-archive.update",{inventory_archive:this.archivedItem.id,confirm_quantity:this.confirm_quantity?1:null}),{onSuccess:()=>{this.$inertia.visit(route("orders.show",{order:this.order.id}))}})}}},A=i(" Edit Inventory Item "),T=i("Unmatch Item"),M={class:"grid gap-4 grid-cols-2"},N=s("span",{class:"font-bold"},"Product:",-1),U=s("span",{class:"font-bold"},"Qty in Order:",-1),J=s("span",{class:"font-bold"},"Inventory ID #:",-1),B=s("span",{class:"font-bold"},"Size:",-1),G={key:0},O={class:"flex items-center justify-between mt-2"},S=i("Quantity:"),z={key:0,class:"flex items-center mb-2"},E={class:"flex items-center justify-between"},K=i("Cancel"),L=i("Update Item"),P=i("Unmatch Item"),F=i(" Unmatch Inventory Item "),H=s("p",null," Are you sure you want to unmatch this item? This will restore the item to inventory, and unmatch it from this order. ",-1),R={class:"flex items-center justify-between"},W=i("No, Cancel"),X=i("Unmatch Item");function Y(Z,n,c,$,e,r){const _=l("jet-danger-button"),d=l("jet-label"),v=l("jet-input-error"),p=l("jet-input"),g=l("jet-checkbox"),I=l("jet-secondary-button"),b=l("jet-button"),q=l("dialog-modal"),C=l("confirmation-modal");return u(),f("span",{onClick:n[7]||(n[7]=m=>e.editingItem=!0),class:"m-1 btn btn-xs btn-ghost bg-gray-100 cursor-pointer"},[i(a("#"+c.archivedItem.inventory_id+(c.archivedItem.quantity_removed>1?" Qty: "+c.archivedItem.quantity_removed:""))+" ",1),o(q,{onClose:n[4]||(n[4]=m=>e.editingItem=!1),show:e.editingItem},{title:t(()=>[A]),aside:t(()=>[r.itemIsGroup?(u(),y(_,{key:0,class:"ml-auto flex justify-end",onClick:r.confirmDeletion},{default:t(()=>[T]),_:1},8,["onClick"])):h("",!0)]),content:t(()=>[s("form",{class:"grid gap-4",onKeydown:n[2]||(n[2]=D(Q((...m)=>r.updateItem&&r.updateItem(...m),["prevent"]),["enter"]))},[s("div",M,[o(d,{class:"col-span-1"},{default:t(()=>[N,i(" "+a(e.item.product_name),1)]),_:1}),o(d,null,{default:t(()=>[U,i(" "+a(r.orderItemQuantity),1)]),_:1}),o(d,null,{default:t(()=>[J,i(" "+a(e.item.inventory_id),1)]),_:1}),o(d,null,{default:t(()=>[B,i(" "+a(e.item.size_name),1)]),_:1})]),r.itemIsGroup?(u(),f("div",G,[o(v,{message:e.item.errors.quantity_removed},null,8,["message"]),s("div",O,[o(d,{class:"font-bold",for:"quantity"},{default:t(()=>[S]),_:1}),o(p,{id:"quantity",type:"number",error:!!e.item.errors.quantity_removed,modelValue:e.item.quantity_removed,"onUpdate:modelValue":n[0]||(n[0]=m=>e.item.quantity_removed=m),modelModifiers:{number:!0}},null,8,["error","modelValue"])])])):h("",!0),s("div",null,[r.needToConfirmQuantity?(u(),f("div",z,[o(d,{class:w({"text-red-500":r.needToConfirmQuantity&&!e.confirm_quantity}),for:"confirm_quantity"},{default:t(()=>[i("Increase quantity of order item from "+a(r.orderItemQuantity)+" to "+a(r.orderItemQuantityAfterAdding)+"?",1)]),_:1},8,["class"]),o(g,{id:"confirm_quantity",modelValue:e.confirm_quantity,"onUpdate:modelValue":n[1]||(n[1]=m=>e.confirm_quantity=m)},null,8,["modelValue"])])):h("",!0),o(v,{message:e.item.errors.confirm_quantity},null,8,["message"])])],32)]),footer:t(()=>[s("div",E,[o(I,{onClick:n[3]||(n[3]=m=>e.editingItem=!1)},{default:t(()=>[K]),_:1}),r.itemIsGroup?(u(),y(b,{key:0,onClick:r.updateItem,class:"ml-auto flex justify-end",disabled:!e.item.isDirty},{default:t(()=>[L]),_:1},8,["onClick","disabled"])):(u(),y(_,{key:1,class:"ml-auto flex justify-end",onClick:r.confirmDeletion},{default:t(()=>[P]),_:1},8,["onClick"]))])]),_:1},8,["show"]),o(C,{show:e.confirmingDeletion,onClose:n[6]||(n[6]=m=>e.confirmingDeletion=!1)},{title:t(()=>[F]),content:t(()=>[H]),footer:t(()=>[s("div",R,[o(I,{onClick:n[5]||(n[5]=m=>e.confirmingDeletion=!1)},{default:t(()=>[W]),_:1}),o(_,{onClick:r.deleteItem,class:"ml-auto flex justify-end"},{default:t(()=>[X]),_:1},8,["onClick"])])]),_:1},8,["show"])])}var ie=x(V,[["render",Y]]);export{ie as default};
