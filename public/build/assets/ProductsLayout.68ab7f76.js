import{A as _}from"./AppLayout.3304023d.js";import{B as f}from"./BackLink.312081a6.js";import h from"./ProductsAside.e43e1337.js";import{M as k}from"./MainArea.def08b37.js";import{_ as v,r as o,o as t,c as s,w as r,a,b as c,J as x,P as i,M as b,d as p}from"./app.fa9cc1ae.js";import"./use-tree-walker.esm.46f3148c.js";import"./description.esm.1831666a.js";import"./ChevronLeftIcon.cd6cd1a4.js";import"./ButtonLink.6e91a4bc.js";import"./TabLink.82ecb71e.js";import"./SearchInput.afb6d862.js";import"./AsideLink.fe2f99e0.js";import"./EmptyState.12be0778.js";const y={components:{ProductsAside:h,AppLayout:_,BackLink:f,MainArea:k},computed:{isIndex(){return route().current("products.index")||route().current("archived-products.index")}}},B={class:"flex-1 relative z-0 flex overflow-hidden"},w={key:0,"aria-label":"Breadcrumb",class:"px-4 md:pb-2 flex items-center justify-between"},A={class:"xl:hidden"},M=p("Products"),P=p("Archived Products"),N={class:"py-2"};function V(e,$,C,I,L,n){const d=o("back-link"),u=o("main-area"),l=o("products-aside"),m=o("app-layout");return t(),s(m,null,{default:r(()=>[a("div",B,[c(u,{dontShowOnMobile:n.isIndex},{default:r(()=>[n.isIndex?b("",!0):(t(),x("nav",w,[a("div",A,[e.route().current("products.*")?(t(),s(d,{key:0,href:e.route("products.index")},{default:r(()=>[M]),_:1},8,["href"])):(t(),s(d,{key:1,href:e.route("archived-products.index")},{default:r(()=>[P]),_:1},8,["href"]))]),i(e.$slots,"nav")])),a("div",N,[i(e.$slots,"default")])]),_:3},8,["dontShowOnMobile"]),c(l)])]),_:3})}var K=v(y,[["render",V]]);export{K as default};