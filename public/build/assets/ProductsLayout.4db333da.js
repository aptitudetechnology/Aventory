import{A as _}from"./AppLayout.00f0692d.js";import{B as f}from"./BackLink.4660460e.js";import h from"./ProductsAside.c91b8b43.js";import{M as k}from"./MainArea.7670109e.js";import{_ as v,r as o,o as t,c as s,w as r,a,b as c,J as x,P as i,M as b,d as p}from"./app.123e766a.js";import"./use-tree-walker.esm.615d46a4.js";import"./description.esm.8bb4746d.js";import"./ChevronLeftIcon.32d69b53.js";import"./ButtonLink.76cb776b.js";import"./TabLink.6500eaa0.js";import"./SearchInput.993ac6a1.js";import"./AsideLink.3cb1a65c.js";import"./EmptyState.fa0384fc.js";const y={components:{ProductsAside:h,AppLayout:_,BackLink:f,MainArea:k},computed:{isIndex(){return route().current("products.index")||route().current("archived-products.index")}}},B={class:"flex-1 relative z-0 flex overflow-hidden"},w={key:0,"aria-label":"Breadcrumb",class:"px-4 md:pb-2 flex items-center justify-between"},A={class:"xl:hidden"},M=p("Products"),P=p("Archived Products"),N={class:"py-2"};function V(e,$,C,I,L,n){const d=o("back-link"),u=o("main-area"),l=o("products-aside"),m=o("app-layout");return t(),s(m,null,{default:r(()=>[a("div",B,[c(u,{dontShowOnMobile:n.isIndex},{default:r(()=>[n.isIndex?b("",!0):(t(),x("nav",w,[a("div",A,[e.route().current("products.*")?(t(),s(d,{key:0,href:e.route("products.index")},{default:r(()=>[M]),_:1},8,["href"])):(t(),s(d,{key:1,href:e.route("archived-products.index")},{default:r(()=>[P]),_:1},8,["href"]))]),i(e.$slots,"nav")])),a("div",N,[i(e.$slots,"default")])]),_:3},8,["dontShowOnMobile"]),c(l)])]),_:3})}var K=v(y,[["render",V]]);export{K as default};
