import p from"./TeamMemberManager.81c61d77.js";import{A as d}from"./AppLayout.00f0692d.js";import u from"./DeleteTeamForm.84c2c4f8.js";import{J as f}from"./SectionBorder.e5d5f9e2.js";import g from"./UpdateTeamForm.c9ed07cb.js";import b from"./ConnectAccounting.a2471ca6.js";import{_ as x,r as t,o as s,c as h,w as n,a,b as o,J as v,W as y,M as w}from"./app.123e766a.js";import"./ActionMessage.df590980.js";import"./ActionSection.c21f2eec.js";import"./ConfirmationModal.82dd7e96.js";import"./Modal.c06c0ace.js";import"./DialogModal.11efde9a.js";import"./FormSection.a31e0947.js";import"./use-tree-walker.esm.615d46a4.js";import"./description.esm.8bb4746d.js";const B={props:["team","availableRoles","permissions"],components:{AppLayout:d,DeleteTeamForm:u,JetSectionBorder:f,TeamMemberManager:p,UpdateTeamForm:g,ConnectAccounting:b}},C=a("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Company Settings ",-1),k={class:"overflow-y-auto h-full"},T={class:"max-w-7xl py-10 sm:px-6 lg:px-8"};function A(F,J,e,M,N,S){const r=t("connect-accounting"),m=t("jet-section-border"),i=t("update-team-form"),c=t("team-member-manager"),l=t("delete-team-form"),_=t("app-layout");return s(),h(_,null,{header:n(()=>[C]),default:n(()=>[a("div",k,[a("div",T,[o(r,{team:e.team},null,8,["team"]),o(m),o(i,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),o(c,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(s(),v(y,{key:0},[o(m),o(l,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):w("",!0)])])]),_:1})}var P=x(B,[["render",A]]);export{P as default};
