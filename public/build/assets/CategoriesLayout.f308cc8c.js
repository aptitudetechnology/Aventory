import{A as l}from"./AppLayout.882645d6.js";import{B as _}from"./BackLink.c23c1c07.js";import m from"./CategoriesAside.2ae39a4a.js";import{M as u}from"./MainArea.39d829c5.js";import{_ as f,r as e,o as i,c as h,w as t,a,b as r,J as g,M as x,P as k,d as b}from"./app.fbac1591.js";import"./use-tree-walker.esm.96420529.js";import"./description.esm.86a5930e.js";import"./ChevronLeftIcon.65bc558d.js";import"./ButtonLink.b5238133.js";import"./AsideLink.a174d96a.js";import"./EmptyState.af78f495.js";const v={components:{CategoriesAside:m,AppLayout:l,BackLink:_,MainArea:u},computed:{categories(){return this.$page.props.categories},isIndex(){return route().current("categories.index")}}},B={class:"flex-1 relative z-0 flex overflow-hidden"},y={key:0,"aria-label":"Breadcrumb",class:"xl:hidden"},C={class:"px-4 md:pb-2"},w=b("Categories"),M={class:"py-2"};function A(s,N,V,I,L,o){const n=e("back-link"),c=e("main-area"),d=e("categories-aside"),p=e("app-layout");return i(),h(p,null,{default:t(()=>[a("div",B,[r(c,{dontShowOnMobile:o.isIndex},{default:t(()=>[o.isIndex?x("",!0):(i(),g("nav",y,[a("div",C,[r(n,{href:s.route("categories.index")},{default:t(()=>[w]),_:1},8,["href"])])])),a("div",M,[k(s.$slots,"default")])]),_:3},8,["dontShowOnMobile"]),r(d,{categories:o.categories},null,8,["categories"])])]),_:3})}var F=f(v,[["render",A]]);export{F as default};