import{A as d}from"./AppLayout.fc980c7c.js";import{B as m}from"./BackLink.a8ed3402.js";import _ from"./PriceLevelsAside.399b997e.js";import{M as u}from"./MainArea.debbbb70.js";import{_ as v}from"./plugin-vue_export-helper.21dcd24c.js";import{r as e,o as i,c as f,w as r,a as t,b as s,t as h,v as x,z as L,d as k}from"./app.c6d51eb6.js";import"./dom.esm.fa0fef86.js";import"./calculate-active-index.esm.611fafbc.js";import"./use-resolve-button-type.esm.4623ef0e.js";import"./use-tree-walker.esm.683d9237.js";import"./description.esm.62a21e39.js";import"./ChevronLeftIcon.644abc42.js";import"./ButtonLink.a3a01f7d.js";import"./AsideLink.57c8023d.js";import"./EmptyState.299ed1ff.js";import"./SectionTitle.6e9e4bb1.js";const b={components:{PriceLevelsAside:_,AppLayout:d,BackLink:m,MainArea:u},computed:{priceLevels(){return this.$page.props.priceLevels},isIndex(){return route().current("price-levels.index")}}},B={class:"flex-1 relative z-0 flex overflow-hidden"},y={key:0,"aria-label":"Breadcrumb",class:"xl:hidden"},w={class:"px-4 md:pb-2"},A=k("Price Levels"),M={class:"py-2"};function N(a,V,C,I,P,o){const c=e("back-link"),n=e("main-area"),l=e("price-levels-aside"),p=e("app-layout");return i(),f(p,null,{default:r(()=>[t("div",B,[s(n,{dontShowOnMobile:o.isIndex},{default:r(()=>[o.isIndex?x("",!0):(i(),h("nav",y,[t("div",w,[s(c,{href:a.route("customer-price-levels.index")},{default:r(()=>[A]),_:1},8,["href"])])])),t("div",M,[L(a.$slots,"default")])]),_:3},8,["dontShowOnMobile"]),s(l,{priceLevels:o.priceLevels},null,8,["priceLevels"])])]),_:3})}var R=v(b,[["render",N]]);export{R as default};
