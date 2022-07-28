import{A as l}from"./AppLayout.61f6b15f.js";import{B as _}from"./BackLink.7902487f.js";import f from"./CustomersAside.a1f169f7.js";import{M as h}from"./MainArea.46d7601f.js";import{_ as k,r as o,o as t,c as a,w as s,a as n,b as i,J as x,M as v,P as b,d as m}from"./app.9dc34ef4.js";import"./use-tree-walker.esm.e2024782.js";import"./description.esm.f365edce.js";import"./ChevronLeftIcon.49588678.js";import"./ButtonLink.8dca3e04.js";import"./TabLink.8aaa87cf.js";import"./SearchInput.e0ea6baa.js";import"./AsideLink.2ef7bd17.js";import"./EmptyState.63a0d90b.js";const y={components:{CustomersAside:f,AppLayout:l,BackLink:_,MainArea:h},computed:{customers(){return this.$page.props.customers},isIndex(){return route().current("customers.index")||route().current("archived-customers.index")}}},B={class:"flex-1 relative z-0 flex overflow-hidden"},C={key:0,"aria-label":"Breadcrumb",class:"xl:hidden"},w={class:"px-4 md:pb-2"},A=m("Customers"),M=m("Archived Customers"),N={class:"py-2"};function V(e,I,L,S,$,r){const c=o("back-link"),d=o("main-area"),u=o("customers-aside"),p=o("app-layout");return t(),a(p,null,{default:s(()=>[n("div",B,[i(d,{dontShowOnMobile:r.isIndex},{default:s(()=>[r.isIndex?v("",!0):(t(),x("nav",C,[n("div",w,[e.route().current("customers.*")?(t(),a(c,{key:0,href:e.route("customers.index")},{default:s(()=>[A]),_:1},8,["href"])):(t(),a(c,{key:1,href:e.route("archived-customers.index")},{default:s(()=>[M]),_:1},8,["href"]))])])),n("div",N,[b(e.$slots,"default")])]),_:3},8,["dontShowOnMobile"]),i(u,{customers:r.customers},null,8,["customers"])])]),_:3})}var K=k(y,[["render",V]]);export{K as default};