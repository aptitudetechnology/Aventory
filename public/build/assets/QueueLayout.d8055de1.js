import{A as d}from"./AppLayout.882645d6.js";import{B as l}from"./BackLink.c23c1c07.js";import{M as _}from"./MainArea.39d829c5.js";import{_ as m,r as t,o,c as r,w as a,b as f,J as k,a as n,M as s,P as h,d as y}from"./app.fbac1591.js";import"./use-tree-walker.esm.96420529.js";import"./description.esm.86a5930e.js";import"./ChevronLeftIcon.65bc558d.js";const b={components:{AppLayout:d,BackLink:l,MainArea:_},computed:{isIndex(){return route().current("reprint-queue.index")}}},x={key:0,"aria-label":"Breadcrumb"},B={class:"px-4 md:pb-2"},v=y("All Inventory in Queue"),A={class:"py-2"};function M(e,N,V,$,q,c){const u=t("back-link"),i=t("main-area"),p=t("app-layout");return o(),r(p,null,{default:a(()=>[f(i,{dontShowOnMobile:!1},{default:a(()=>[c.isIndex?s("",!0):(o(),k("nav",x,[n("div",B,[e.route().current("reprint-queue.*")?(o(),r(u,{key:0,href:e.route("reprint-queue.index")},{default:a(()=>[v]),_:1},8,["href"])):s("",!0)])])),n("div",A,[h(e.$slots,"default")])]),_:3})]),_:3})}var J=m(b,[["render",M]]);export{J as default};