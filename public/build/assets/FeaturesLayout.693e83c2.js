import{A as u}from"./AppLayout.61f6b15f.js";import{B as l}from"./BackLink.7902487f.js";import _ from"./FeaturesAside.e8b33cc5.js";import{M as m}from"./MainArea.46d7601f.js";import{_ as f,r as e,o as n,c as h,w as a,a as o,b as r,J as x,M as k,P as b,d as v}from"./app.9dc34ef4.js";import"./use-tree-walker.esm.e2024782.js";import"./description.esm.f365edce.js";import"./ChevronLeftIcon.49588678.js";import"./ButtonLink.8dca3e04.js";import"./AsideLink.2ef7bd17.js";import"./EmptyState.63a0d90b.js";const B={components:{FeaturesAside:_,AppLayout:u,BackLink:l,MainArea:m},computed:{features(){return this.$page.props.features},isIndex(){return route().current("features.index")}}},y={class:"flex-1 relative z-0 flex overflow-hidden"},w={key:0,"aria-label":"Breadcrumb",class:"xl:hidden"},M={class:"px-4 md:pb-2"},A=v("Features"),N={class:"py-2"};function V(s,C,F,I,L,t){const i=e("back-link"),c=e("main-area"),d=e("features-aside"),p=e("app-layout");return n(),h(p,null,{default:a(()=>[o("div",y,[r(c,{dontShowOnMobile:t.isIndex},{default:a(()=>[t.isIndex?k("",!0):(n(),x("nav",w,[o("div",M,[r(i,{href:s.route("features.index")},{default:a(()=>[A]),_:1},8,["href"])])])),o("div",N,[b(s.$slots,"default")])]),_:3},8,["dontShowOnMobile"]),r(d,{features:t.features},null,8,["features"])])]),_:3})}var D=f(B,[["render",V]]);export{D as default};