import{B as g}from"./ButtonLink.8dca3e04.js";import{P as w,A as B}from"./AsideLink.2ef7bd17.js";import{E as N}from"./EmptyState.63a0d90b.js";import{_ as v,a7 as A,r,o as s,c as _,w as n,b as u,a as t,J as i,X as L,N as l,W as d,M as a,d as c}from"./app.9dc34ef4.js";const S={components:{PageAside:w,AsideLink:B,ButtonLink:g,EmptyState:N,JetSectionTitle:A},props:{blocks:Array},computed:{blocksLength:function(){return this.blocks.length}}},z=c("Nursery Blocks"),C=c("New Block"),V={class:"bg-white"},E={class:"divide-y divide-gray-200"},M={class:"flex-1 min-w-0"},T={class:"focus:outline-none"},j=t("span",{class:"absolute inset-0","aria-hidden":"true"},null,-1),D={class:"text-sm text-gray-900"},J=["set"],O=c("\xA0 "),P=c("\xA0 "),$=c("\xA0 ");function F(e,G,h,W,X,p){const k=r("button-link"),m=r("jet-section-title"),y=r("aside-link"),f=r("empty-state"),b=r("page-aside");return s(),_(b,{showOnMobile:e.route().current("blocks.index")},{header:n(()=>[u(m,null,{title:n(()=>[z]),aside:n(()=>[u(k,{href:e.route("blocks.create")},{default:n(()=>[C]),_:1},8,["href"])]),_:1})]),default:n(()=>[t("div",V,[t("ul",E,[(s(!0),i(d,null,L(h.blocks,o=>(s(),i("li",{key:o.id,class:"bg-white"},[u(y,{href:e.route("blocks.show",o.id),current:e.route().current("blocks.show",o.id)||e.route().current("blocks.edit",o.id)},{default:n(()=>[t("div",M,[t("div",T,[j,t("div",D,[t("p",null,l(o.BlockDisplayName),1),o.nursery_location?(s(),i("p",{key:0,class:"text-sm text-gray-500 truncate",set:{city:e.city,zip:e.zip,state:e.state}=o.nursery_location},[e.city?(s(),i(d,{key:0},[t("strong",null,"City : "+l(e.city),1),O],64)):a("",!0),e.zip?(s(),i(d,{key:1},[t("strong",null,"Zip : "+l(e.zip),1),P],64)):a("",!0),e.state?(s(),i(d,{key:2},[t("strong",null,"State : "+l(e.state),1),$],64)):a("",!0)],8,J)):a("",!0)])])])]),_:2},1032,["href","current"])]))),128))])]),p.blocksLength<1&&e.route().current("blocks.index")?(s(),_(f,{key:0,heading:"No Blocks",subtitle:"Get started by creating a new block.","button-text":"New Block",href:e.route("blocks.create")},null,8,["href"])):a("",!0)]),_:1},8,["showOnMobile"])}var K=v(S,[["render",F]]);export{K as default};
