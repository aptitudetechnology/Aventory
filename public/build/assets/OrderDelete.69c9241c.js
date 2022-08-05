import{J as p}from"./ActionSection.8b02576e.js";import{J as h}from"./ConfirmationModal.47b3bac6.js";import{_ as y,a1 as D,a6 as g,r as s,o as b,c as C,w as e,a as i,N as o,b as d,d as a}from"./app.9dc34ef4.js";import"./Modal.c8b704a0.js";const O={props:["order"],components:{JetActionSection:p,JetConfirmationModal:h,JetDangerButton:D,JetSecondaryButton:g},data(){return{confirmingOrderDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmOrderDeletion(){this.confirmingOrderDeletion=!0},deleteOrder(){this.order.is_quote?this.form.delete(route("quotes.destroy",this.order.id)):this.form.delete(route("orders.destroy",this.order.id))}}},v={class:"capitalize"},j={class:"text-sm text-gray-600"},w={class:"mt-5"},k={class:"capitalize"},x=a(" Cancel "),J=a(" Yes, Delete ");function B(N,n,t,S,r,c){const l=s("jet-danger-button"),_=s("jet-secondary-button"),m=s("jet-confirmation-modal"),f=s("jet-action-section");return b(),C(f,null,{title:e(()=>[i("span",v,"Delete "+o(t.order.type),1)]),content:e(()=>[i("div",j," If this "+o(t.order.type)+" is deleted, all associated products and services, associated shipments, and associated invoices will be deleted. This is permanent and cannot be undone. ",1),i("div",w,[d(l,{onClick:c.confirmOrderDeletion},{default:e(()=>[a(" Delete "+o(t.order.type),1)]),_:1},8,["onClick"])]),d(m,{show:r.confirmingOrderDeletion,onClose:n[1]||(n[1]=u=>r.confirmingOrderDeletion=!1)},{title:e(()=>[i("span",k," Delete "+o(t.order.type),1)]),content:e(()=>[a(" Are you sure you want to delete this "+o(t.order.type)+"? There will be no way to recover it. ",1)]),footer:e(()=>[d(_,{onClick:n[0]||(n[0]=u=>r.confirmingOrderDeletion=!1)},{default:e(()=>[x]),_:1}),d(l,{class:"ml-2",onClick:c.deleteOrder,disabled:r.form.processing},{default:e(()=>[J]),_:1},8,["onClick","disabled"])]),_:1},8,["show"])]),_:1})}var A=y(O,[["render",B]]);export{A as default};
