import{J as u}from"./ConfirmationModal.82dd7e96.js";import{_ as p,a1 as g,a6 as h,r as n,o as D,J as y,b as r,O,w as t,W as I,d as i,N as l,L as C}from"./app.123e766a.js";import{D as b}from"./DeleteButton.6111e10e.js";import"./Modal.c06c0ace.js";import"./TrashIcon.22389a9d.js";const v={props:["item"],components:{JetConfirmationModal:u,JetDangerButton:g,JetSecondaryButton:h,DeleteButton:b},data(){return{confirmingOrderItemDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmOrderItemDeletion(){this.confirmingOrderItemDeletion=!0},deleteOrderItem(){this.form.delete(route("sales.order-items.destroy",[this.item.order_id,this.item]),{errorBag:"deleteOrderItem",preserveState:!1})}}},k=i(" Cancel "),B=i(" Remove Order Item ");function w(j,o,s,x,e,m){const a=n("DeleteButton"),d=n("jet-secondary-button"),c=n("jet-danger-button"),f=n("jet-confirmation-modal");return D(),y(I,null,[r(a,{type:"button",onClick:O(m.confirmOrderItemDeletion,["stop"])},null,8,["onClick"]),r(f,{show:e.confirmingOrderItemDeletion,onClose:o[1]||(o[1]=_=>e.confirmingOrderItemDeletion=!1)},{title:t(()=>[i(" Remove item from "+l(s.item.sale_type),1)]),content:t(()=>[i(" Are you sure you want to delete this item? "+l(s.item.sale_type=="order"?"This will add all matched inventory for this item back to inventory.":"")+" This action cannot be undone. ",1)]),footer:t(()=>[r(d,{onClick:o[0]||(o[0]=_=>e.confirmingOrderItemDeletion=!1)},{default:t(()=>[k]),_:1}),r(c,{class:C(["ml-2",{"opacity-25":e.form.processing}]),onClick:m.deleteOrderItem,disabled:e.form.processing},{default:t(()=>[B]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])],64)}var R=p(v,[["render",w]]);export{R as default};
