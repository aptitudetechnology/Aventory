import{J as d}from"./ActionSection.cf8bfbe1.js";import{J as _}from"./ConfirmationModal.5724143c.js";import{_ as C,a1 as u,a6 as p,r as a,o as g,J as D,b as c,w as t,d as o,N as h,L as y}from"./app.fbac1591.js";import"./Modal.bd4b42b5.js";const b={props:["contact"],components:{JetActionSection:d,JetConfirmationModal:_,JetDangerButton:u,JetSecondaryButton:p},data(){return{confirmingContactDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmContactDeletion(){this.confirmingContactDeletion=!0},deleteContact(){this.form.delete(route("contacts.destroy",{contact:this.contact}),{errorBag:"deleteContact"})}}},k=o(" Delete "),J=o(" Delete Contact "),j=o(" Cancel "),v=o(" Delete Contact ");function w(x,n,r,B,e,s){const i=a("jet-danger-button"),l=a("jet-secondary-button"),m=a("jet-confirmation-modal");return g(),D("div",null,[c(i,{onClick:s.confirmContactDeletion},{default:t(()=>[k]),_:1},8,["onClick"]),c(m,{show:e.confirmingContactDeletion,onClose:n[1]||(n[1]=f=>e.confirmingContactDeletion=!1)},{title:t(()=>[J]),content:t(()=>[o(" Are you sure you want to delete "+h(r.contact.first_name)+"? ",1)]),footer:t(()=>[c(l,{onClick:n[0]||(n[0]=f=>e.confirmingContactDeletion=!1)},{default:t(()=>[j]),_:1}),c(i,{class:y(["ml-2",{"opacity-25":e.form.processing}]),onClick:s.deleteContact,disabled:e.form.processing},{default:t(()=>[v]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])])}var z=C(b,[["render",w]]);export{z as default};