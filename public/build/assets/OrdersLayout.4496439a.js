import{A as _}from"./AppLayout.3304023d.js";import{B as m}from"./BackLink.312081a6.js";import{M as u}from"./MainArea.def08b37.js";import{_ as l,r as o,o as r,c as a,w as t,b as f,J as k,a as s,M as n,P as h,d as x}from"./app.fa9cc1ae.js";import"./use-tree-walker.esm.46f3148c.js";import"./description.esm.1831666a.js";import"./ChevronLeftIcon.cd6cd1a4.js";const b={components:{AppLayout:_,BackLink:m,MainArea:u},computed:{isIndex(){return route().current("orders.index")||route().current("archived-orders.index")}}},y={key:0,"aria-label":"Breadcrumb"},B={class:"px-4 md:pb-2"},v=x("Orders"),M={class:"py-2"};function N(e,V,$,w,A,c){const d=o("back-link"),i=o("main-area"),p=o("app-layout");return r(),a(p,null,{default:t(()=>[f(i,{dontShowOnMobile:!1},{default:t(()=>[c.isIndex?n("",!0):(r(),k("nav",y,[s("div",B,[e.route().current("orders.*")?(r(),a(d,{key:0,href:e.route("orders.index")},{default:t(()=>[v]),_:1},8,["href"])):n("",!0)])])),s("div",M,[h(e.$slots,"default")])]),_:3})]),_:3})}var P=l(b,[["render",N]]);export{P as default};