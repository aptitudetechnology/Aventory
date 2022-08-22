import{J as p}from"./ConfirmationModal.82dd7e96.js";import{_ as f,a1 as _,a6 as u,r as n,o as h,J as g,b as r,w as o,W as P,L as C,d as i}from"./app.123e766a.js";import{T as D}from"./TrashIcon.22389a9d.js";import"./Modal.c06c0ace.js";const w={props:["price"],components:{JetConfirmationModal:p,JetDangerButton:_,JetSecondaryButton:u,TrashIcon:D},data(){return{confirmingPriceDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmPriceDeletion(){this.confirmingPriceDeletion=!0},deletePrice(){this.form.delete(route("prices.destroy",this.price),{errorBag:"deletePrice",preserveState:!0})}}},b=i(" Delete Price "),y=i(" Are you sure you want to delete this price? All products in inventory with this price will be given a null price and all product pricing with this price will be deleted. "),k=i(" Cancel "),v=i(" Delete Price ");function j(x,t,B,J,e,s){const c=n("TrashIcon"),l=n("jet-secondary-button"),a=n("jet-danger-button"),m=n("jet-confirmation-modal");return h(),g(P,null,[r(c,{onClick:s.confirmPriceDeletion,class:"w-6 h-6 mx-auto cursor-pointer"},null,8,["onClick"]),r(m,{show:e.confirmingPriceDeletion,onClose:t[1]||(t[1]=d=>e.confirmingPriceDeletion=!1)},{title:o(()=>[b]),content:o(()=>[y]),footer:o(()=>[r(l,{onClick:t[0]||(t[0]=d=>e.confirmingPriceDeletion=!1)},{default:o(()=>[k]),_:1}),r(a,{class:C(["ml-2",{"opacity-25":e.form.processing}]),onClick:s.deletePrice,disabled:e.form.processing},{default:o(()=>[v]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])],64)}var S=f(w,[["render",j]]);export{S as default};
