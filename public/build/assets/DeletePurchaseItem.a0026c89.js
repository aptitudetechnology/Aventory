import{J as d}from"./ConfirmationModal.82dd7e96.js";import{_ as f,a1 as _,a6 as p,r as n,o as h,J as D,b as s,w as t,W as g,L as I,d as r}from"./app.123e766a.js";import{D as C}from"./DeleteButton.6111e10e.js";import"./Modal.c06c0ace.js";import"./TrashIcon.22389a9d.js";const P={props:["item"],components:{JetConfirmationModal:d,JetDangerButton:_,JetSecondaryButton:p,DeleteButton:C},data(){return{confirmingPurchaseItemDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmPurchaseItemDeletion(){this.confirmingPurchaseItemDeletion=!0},deletePurchaseItem(){this.form.delete(route("purchase-item.destroy",this.item),{errorBag:"deletePurchaseItem",preserveState:!1})}}},y=r(" Delete Item "),b=r(" Are you sure you want to delete this item? All products in inventory associated to this item will be permanentaly deleted from inventory! "),B=r(" Cancel "),k=r(" Delete Item ");function v(j,o,w,x,e,i){const a=n("DeleteButton"),l=n("jet-secondary-button"),m=n("jet-danger-button"),c=n("jet-confirmation-modal");return h(),D(g,null,[s(a,{onClick:i.confirmPurchaseItemDeletion},null,8,["onClick"]),s(c,{show:e.confirmingPurchaseItemDeletion,onClose:o[1]||(o[1]=u=>e.confirmingPurchaseItemDeletion=!1)},{title:t(()=>[y]),content:t(()=>[b]),footer:t(()=>[s(l,{onClick:o[0]||(o[0]=u=>e.confirmingPurchaseItemDeletion=!1)},{default:t(()=>[B]),_:1}),s(m,{class:I(["ml-2",{"opacity-25":e.form.processing}]),onClick:i.deletePurchaseItem,disabled:e.form.processing},{default:t(()=>[k]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])],64)}var z=f(P,[["render",v]]);export{z as default};
