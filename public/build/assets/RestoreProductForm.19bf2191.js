import{J as _}from"./ActionSection.21b87dec.js";import{J as f}from"./ConfirmationModal.08e30afa.js";import{J as p}from"./Button.9edbaae6.js";import{J as h}from"./SecondaryButton.d03b45d1.js";import{_ as P}from"./plugin-vue_export-helper.21dcd24c.js";import{r as s,o as R,c as b,w as o,a,b as n,u as w,d as t}from"./app.c6d51eb6.js";import"./SectionTitle.6e9e4bb1.js";import"./Modal.a8ddeb0e.js";const g={props:["product"],components:{JetActionSection:_,JetConfirmationModal:f,JetButton:p,JetSecondaryButton:h},data(){return{confirmingProductRestoration:!1,restoring:!1,form:this.$inertia.form()}},methods:{confirmProductRestoration(){this.confirmingProductRestoration=!0},RestoreProduct(){this.form.post(route("archived-products.restore",this.product.id),{errorBag:"restoreProduct"})}}},C=t("Restore Product "),x=t("Restore this product. You will be able to create new orders and quotes with this product and will no longer be archived."),j=a("div",{class:"max-w-xl text-sm text-gray-600"}," Once a product is restored, you will be able to create orders with this product. ",-1),v={class:"mt-5"},y=t(" Restore Product "),J=t(" Restore Product "),k=t(" Are you sure you want to restore this product? "),B=t(" Cancel "),N=t(" Restore Product ");function V(A,r,S,q,e,c){const i=s("jet-button"),d=s("jet-secondary-button"),u=s("jet-confirmation-modal"),m=s("jet-action-section");return R(),b(m,null,{title:o(()=>[C]),description:o(()=>[x]),content:o(()=>[j,a("div",v,[n(i,{onClick:c.confirmProductRestoration},{default:o(()=>[y]),_:1},8,["onClick"])]),n(u,{show:e.confirmingProductRestoration,onClose:r[1]||(r[1]=l=>e.confirmingProductRestoration=!1)},{title:o(()=>[J]),content:o(()=>[k]),footer:o(()=>[n(d,{onClick:r[0]||(r[0]=l=>e.confirmingProductRestoration=!1)},{default:o(()=>[B]),_:1}),n(i,{class:w(["ml-2",{"opacity-25":e.form.processing}]),onClick:c.RestoreProduct,disabled:e.form.processing},{default:o(()=>[N]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])]),_:1})}var G=P(g,[["render",V]]);export{G as default};
