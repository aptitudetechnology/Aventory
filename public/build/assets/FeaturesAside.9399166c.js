import{B as g}from"./ButtonLink.76cb776b.js";import{P as w,A as k}from"./AsideLink.3cb1a65c.js";import{E as b}from"./EmptyState.fa0384fc.js";import{_ as N,a7 as v,r as n,o as a,c as u,w as e,b as r,a as o,J as i,X as x,N as l,M as _,W as B,d as c}from"./app.123e766a.js";const F={components:{PageAside:w,AsideLink:k,ButtonLink:g,EmptyState:b,JetSectionTitle:v},props:{features:Array}},A=c("Plant Features"),V=c("View your plant features."),S=c("New Feature"),C={class:"bg-white"},E={class:"divide-y divide-gray-200"},L={class:"flex-1 min-w-0"},M={class:"focus:outline-none"},P=o("span",{class:"absolute inset-0","aria-hidden":"true"},null,-1),T={class:"text-sm text-gray-900"},j={key:0,class:"text-sm text-gray-500 truncate"};function J(t,O,d,$,D,G){const p=n("button-link"),h=n("jet-section-title"),m=n("aside-link"),f=n("empty-state"),y=n("page-aside");return a(),u(y,{showOnMobile:t.route().current("features.index")},{header:e(()=>[r(h,null,{title:e(()=>[A]),description:e(()=>[V]),aside:e(()=>[r(p,{href:t.route("features.create")},{default:e(()=>[S]),_:1},8,["href"])]),_:1})]),default:e(()=>[o("div",C,[o("ul",E,[(a(!0),i(B,null,x(d.features,s=>(a(),i("li",{key:s.id,class:"bg-white"},[r(m,{href:t.route("features.show",s.id),current:t.route().current("features.show",s.id)},{default:e(()=>[o("div",L,[o("div",M,[P,o("p",T,l(s.name),1),s.description?(a(),i("p",j,l(s.description),1)):_("",!0)])])]),_:2},1032,["href","current"])]))),128))])]),d.features.length<1&&t.route().current("features.index")?(a(),u(f,{key:0,heading:"No Features",subtitle:"Get started by creating a new plant feature.","button-text":"New Feature",href:t.route("features.create")},null,8,["href"])):_("",!0)]),_:1},8,["showOnMobile"])}var H=N(F,[["render",J]]);export{H as default};
