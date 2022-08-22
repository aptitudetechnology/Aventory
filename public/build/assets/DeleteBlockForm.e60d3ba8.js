import{J as f}from"./ActionSection.0b0eae6e.js";import{J as k}from"./ConfirmationModal.2e591634.js";import{_ as p,a1 as u,a6 as B,r as s,o as b,c as h,w as e,a as r,b as l,L as g,d as o}from"./app.fa9cc1ae.js";import"./Modal.66389f43.js";const D={props:{block:Object},components:{JetActionSection:f,JetConfirmationModal:k,JetDangerButton:u,JetSecondaryButton:B},data(){return{confirmingBlockDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmBlockDeletion(){this.confirmingBlockDeletion=!0},deleteBlock(){this.form.delete(route("blocks.destroy",this.block),{errorBag:"deleteBlock"})}}},C=o(" Delete Block "),j=o(" Delete this block. "),x=r("div",{class:"max-w-xl text-sm text-gray-600"}," Once a block is deleted, all places in this block will be deleted, and all inventory assigned to this block will be given an unnasigned location. ",-1),y={class:"mt-5"},v=o(" Delete Block "),w=o(" Delete Block "),J=o(" Are you sure you want to delete this block? "),N=o(" Cancel "),V=o(" Delete Block ");function A(O,n,S,z,t,c){const i=s("jet-danger-button"),a=s("jet-secondary-button"),d=s("jet-confirmation-modal"),_=s("jet-action-section");return b(),h(_,null,{title:e(()=>[C]),description:e(()=>[j]),content:e(()=>[x,r("div",y,[l(i,{onClick:c.confirmBlockDeletion},{default:e(()=>[v]),_:1},8,["onClick"])]),l(d,{show:t.confirmingBlockDeletion,onClose:n[1]||(n[1]=m=>t.confirmingBlockDeletion=!1)},{title:e(()=>[w]),content:e(()=>[J]),footer:e(()=>[l(a,{onClick:n[0]||(n[0]=m=>t.confirmingBlockDeletion=!1)},{default:e(()=>[N]),_:1}),l(i,{class:g(["ml-2",{"opacity-25":t.form.processing}]),onClick:c.deleteBlock,disabled:t.form.processing},{default:e(()=>[V]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])]),_:1})}var q=p(D,[["render",A]]);export{q as default};