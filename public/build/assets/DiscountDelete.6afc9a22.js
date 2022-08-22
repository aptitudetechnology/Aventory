import{J as m}from"./ConfirmationModal.82dd7e96.js";import{_ as f,a1 as _,r as i,o as D,J as p,b as s,w as e,O as h,d as o,N as g,L as C}from"./app.123e766a.js";import{D as b}from"./DeleteButton.6111e10e.js";import"./Modal.c06c0ace.js";import"./TrashIcon.22389a9d.js";const y={props:["discount"],components:{JetConfirmationModal:m,JetDangerButton:_,DeleteButton:b},data(){return{confirmingDiscountDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmDiscountDeletion(){this.confirmingDiscountDeletion=!0},deleteDiscount(){this.form.delete(route("sales.discounts.destroy",[this.discount.order_id,this.discount.id]),{errorBag:"deleteDiscount",preserveState:!1})}}},k=o("Remove Discount"),v=o(" Delete Discount "),j=o(" Cancel "),w=o(" Delete Discount ");function x(B,n,l,J,t,r){const c=i("jet-danger-button"),a=i("jet-secondary-button"),u=i("jet-confirmation-modal");return D(),p("div",null,[s(c,{type:"button",onClick:h(r.confirmDiscountDeletion,["stop"])},{default:e(()=>[k]),_:1},8,["onClick"]),s(u,{show:t.confirmingDiscountDeletion,onClose:n[1]||(n[1]=d=>t.confirmingDiscountDeletion=!1)},{title:e(()=>[v]),content:e(()=>[o(" Are you sure you want to delete this discount from the "+g(l.discount.sale_type)+"? This action cannot be undone. ",1)]),footer:e(()=>[s(a,{onClick:n[0]||(n[0]=d=>t.confirmingDiscountDeletion=!1)},{default:e(()=>[j]),_:1}),s(c,{class:C(["ml-2",{"opacity-25":t.form.processing}]),onClick:r.deleteDiscount,disabled:t.form.processing},{default:e(()=>[w]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])])}var z=f(y,[["render",x]]);export{z as default};
