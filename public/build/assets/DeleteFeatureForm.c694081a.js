import{J as f}from"./ActionSection.0b0eae6e.js";import{J as p}from"./ConfirmationModal.2e591634.js";import{_ as g,a1 as h,a6 as F,r,o as D,c as C,w as e,d as t,N as b,a as l,b as s,L as y}from"./app.fa9cc1ae.js";import"./Modal.66389f43.js";const j={props:{feature:Object},components:{JetActionSection:f,JetConfirmationModal:p,JetDangerButton:h,JetSecondaryButton:F},data(){return{confirmingFeatureDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmFeatureDeletion(){this.confirmingFeatureDeletion=!0},deleteFeature(){this.form.delete(route("features.destroy",this.feature),{errorBag:"deleteFeature"})}}},x=t(" Delete Feature "),v=l("div",{class:"max-w-xl text-sm text-gray-600"}," Once a feature is deleted, you will not be able to recover it again. ",-1),w={class:"mt-5"},k=t(" Delete Feature "),B=t(" Delete Feature "),J=t(" Are you sure you want to delete this feature? "),N=t(" Cancel "),A=t(" Delete Feature ");function S(V,n,c,O,o,a){const i=r("jet-danger-button"),u=r("jet-secondary-button"),_=r("jet-confirmation-modal"),d=r("jet-action-section");return D(),C(d,null,{title:e(()=>[x]),description:e(()=>[t(" Delete "+b(c.feature.name)+". All products containing this feature will no longer have it. ",1)]),content:e(()=>[v,l("div",w,[s(i,{onClick:a.confirmFeatureDeletion},{default:e(()=>[k]),_:1},8,["onClick"])]),s(_,{show:o.confirmingFeatureDeletion,onClose:n[1]||(n[1]=m=>o.confirmingFeatureDeletion=!1)},{title:e(()=>[B]),content:e(()=>[J]),footer:e(()=>[s(u,{onClick:n[0]||(n[0]=m=>o.confirmingFeatureDeletion=!1)},{default:e(()=>[N]),_:1}),s(i,{class:y(["ml-2",{"opacity-25":o.form.processing}]),onClick:a.deleteFeature,disabled:o.form.processing},{default:e(()=>[A]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])]),_:1})}var q=g(j,[["render",S]]);export{q as default};