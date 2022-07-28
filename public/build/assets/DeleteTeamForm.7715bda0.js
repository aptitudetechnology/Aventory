import{J as f}from"./ActionSection.21b87dec.js";import{J as p}from"./ConfirmationModal.08e30afa.js";import{J as u}from"./DangerButton.21c54749.js";import{J as h}from"./SecondaryButton.d03b45d1.js";import{_ as g}from"./plugin-vue_export-helper.21dcd24c.js";import{r as a,o as T,c as y,w as e,a as m,b as s,u as D,d as t}from"./app.c6d51eb6.js";import"./SectionTitle.6e9e4bb1.js";import"./Modal.a8ddeb0e.js";const C={props:["team"],components:{JetActionSection:f,JetConfirmationModal:p,JetDangerButton:u,JetSecondaryButton:h},data(){return{confirmingTeamDeletion:!1,deleting:!1,form:this.$inertia.form()}},methods:{confirmTeamDeletion(){this.confirmingTeamDeletion=!0},deleteTeam(){this.form.delete(route("teams.destroy",this.team),{errorBag:"deleteTeam"})}}},w=t(" Delete Team "),b=t(" Permanently delete this team. "),x=m("div",{class:"max-w-xl text-sm text-gray-600"}," Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain. ",-1),j={class:"mt-5"},J=t(" Delete Team "),k=t(" Delete Team "),B=t(" Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted. "),v=t(" Cancel "),N=t(" Delete Team ");function V(A,n,O,S,o,i){const r=a("jet-danger-button"),l=a("jet-secondary-button"),c=a("jet-confirmation-modal"),d=a("jet-action-section");return T(),y(d,null,{title:e(()=>[w]),description:e(()=>[b]),content:e(()=>[x,m("div",j,[s(r,{onClick:i.confirmTeamDeletion},{default:e(()=>[J]),_:1},8,["onClick"])]),s(c,{show:o.confirmingTeamDeletion,onClose:n[1]||(n[1]=_=>o.confirmingTeamDeletion=!1)},{title:e(()=>[k]),content:e(()=>[B]),footer:e(()=>[s(l,{onClick:n[0]||(n[0]=_=>o.confirmingTeamDeletion=!1)},{default:e(()=>[v]),_:1}),s(r,{class:D(["ml-2",{"opacity-25":o.form.processing}]),onClick:i.deleteTeam,disabled:o.form.processing},{default:e(()=>[N]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show"])]),_:1})}var I=g(C,[["render",V]]);export{I as default};
