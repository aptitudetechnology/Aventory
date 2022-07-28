import{J as f}from"./ActionSection.21b87dec.js";import{J as p}from"./ConfirmationModal.08e30afa.js";import{J as u}from"./DangerButton.21c54749.js";import{J as h}from"./SecondaryButton.d03b45d1.js";import{_ as g}from"./plugin-vue_export-helper.21dcd24c.js";import{r as i,o as L,c as D,w as o,a as l,b as s,u as b,d as t}from"./app.c6d51eb6.js";import"./SectionTitle.6e9e4bb1.js";import"./Modal.a8ddeb0e.js";const C={props:{location:Object},components:{JetActionSection:f,JetConfirmationModal:p,JetDangerButton:u,JetSecondaryButton:h},data(){return{confirmingLocationDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmLocationDeletion(){this.confirmingLocationDeletion=!0},deleteLocation(){this.form.delete(route("locations.destroy",this.location),{errorBag:"deleteLocation"})}}},y=t(" Delete Location "),j=t(" Delete this location. "),k=l("div",{class:"max-w-xl text-sm text-gray-600"}," Once a location is deleted, all blocks in this location will be deleted, and all inventory in blocks at this nursery location will given an unnasigned location. ",-1),x={class:"mt-5"},v=t(" Delete Location "),w=t(" Delete Location "),J=t(" Are you sure you want to delete this location? "),B=t(" Cancel "),N=t(" Delete Location ");function V(A,n,O,S,e,c){const a=i("jet-danger-button"),r=i("jet-secondary-button"),d=i("jet-confirmation-modal"),m=i("jet-action-section");return L(),D(m,null,{title:o(()=>[y]),description:o(()=>[j]),content:o(()=>[k,l("div",x,[s(a,{onClick:c.confirmLocationDeletion},{default:o(()=>[v]),_:1},8,["onClick"])]),s(d,{show:e.confirmingLocationDeletion,onClose:n[1]||(n[1]=_=>e.confirmingLocationDeletion=!1)},{title:o(()=>[w]),content:o(()=>[J]),footer:o(()=>[s(r,{onClick:n[0]||(n[0]=_=>e.confirmingLocationDeletion=!1)},{default:o(()=>[B]),_:1}),s(a,{class:b(["ml-2",{"opacity-25":e.form.processing}]),onClick:c.deleteLocation,disabled:e.form.processing},{default:o(()=>[N]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])]),_:1})}var I=g(C,[["render",V]]);export{I as default};
