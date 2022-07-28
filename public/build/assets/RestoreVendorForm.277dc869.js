import{J as f}from"./ActionSection.8b02576e.js";import{J as p}from"./ConfirmationModal.47b3bac6.js";import{_ as u,a0 as h,a6 as v,r,o as V,c as b,w as o,a as c,b as s,L as g,d as e}from"./app.9dc34ef4.js";import"./Modal.c8b704a0.js";const R={props:["vendor"],components:{JetActionSection:f,JetConfirmationModal:p,JetButton:h,JetSecondaryButton:v},data(){return{confirmingVendorRestoration:!1,restoring:!1,form:this.$inertia.form()}},methods:{confirmVendorRestoration(){this.confirmingVendorRestoration=!0},restoreVendor(){this.form.post(route("archived-vendors.restore",this.vendor.id),{errorBag:"restoreVendor"})}}},w=e("Restore Vendor "),C=e("Restore this vendor. You will be able to bring in new inventory with this vendor and it will no longer be archived."),y=c("div",{class:"max-w-xl text-sm text-gray-600"}," Once a vendor is restored, you will be able to bring in inventory from this vendor. ",-1),x={class:"mt-5"},j=e(" Restore Vendor "),k=e(" Restore Vendor "),B=e(" Are you sure you want to restore this vendor? "),J=e(" Cancel "),N=e(" Restore Vendor ");function A(S,n,z,F,t,i){const a=r("jet-button"),d=r("jet-secondary-button"),l=r("jet-confirmation-modal"),_=r("jet-action-section");return V(),b(_,null,{title:o(()=>[w]),description:o(()=>[C]),content:o(()=>[y,c("div",x,[s(a,{onClick:i.confirmVendorRestoration},{default:o(()=>[j]),_:1},8,["onClick"])]),s(l,{show:t.confirmingVendorRestoration,onClose:n[1]||(n[1]=m=>t.confirmingVendorRestoration=!1)},{title:o(()=>[k]),content:o(()=>[B]),footer:o(()=>[s(d,{onClick:n[0]||(n[0]=m=>t.confirmingVendorRestoration=!1)},{default:o(()=>[J]),_:1}),s(a,{class:g(["ml-2",{"opacity-25":t.form.processing}]),onClick:i.restoreVendor,disabled:t.form.processing},{default:o(()=>[N]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])]),_:1})}var Y=u(R,[["render",A]]);export{Y as default};