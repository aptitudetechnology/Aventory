import{o as e,c as s,b as m,_ as u,r as _,J as o,a as t,w as c,W as h,X as p,d as l,N as w,L as g,M as f}from"./app.fbac1591.js";function X(r,a){return e(),s("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","aria-hidden":"true"},[m("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M19 14l-7 7m0 0l-7-7m7 7V3"})])}function q(r,a){return e(),s("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","aria-hidden":"true"},[m("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M5 10l7-7m0 0l7 7m-7-7v18"})])}function A(r,a){return e(),s("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","aria-hidden":"true"},[m("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"})])}const v={props:{items:{type:Object}},computed:{links(){return this.items.links.filter(r=>!r.label.includes("Next")&&!r.label.includes("Previous"))}},onMounted(){console.log(this.items.links)}},k={key:0,class:"border-t border-gray-200 px-4 flex items-center justify-between sm:px-0"},y={class:"-mt-px w-0 flex-1 flex"},b={key:0,class:"border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 cursor-not-allowed"},B=t("svg",{class:"mr-3 h-5 w-5 text-gray-400",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M7 16l-4-4m0 0l4-4m-4 4h18"})],-1),C=l(" Previous "),j=[B,C],M=t("svg",{class:"mr-3 h-5 w-5 text-gray-400",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M7 16l-4-4m0 0l4-4m-4 4h18"})],-1),N=l(" Previous "),L={class:"hidden md:-mt-px md:flex"},P={key:1,class:"border-transparent text-gray-500 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"},V={class:"-mt-px w-0 flex-1 flex justify-end"},H={key:0,class:"border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 cursor-not-allowed"},z=l(" Next "),D=t("svg",{class:"ml-3 h-5 w-5 text-gray-400",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M17 8l4 4m0 0l-4 4m4-4H3"})],-1),E=[z,D],F=l(" Next "),J=t("svg",{class:"ml-3 h-5 w-5 text-gray-400",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M17 8l4 4m0 0l-4 4m4-4H3"})],-1);function O(r,a,n,S,T,x){const d=_("Link");return n.items.links.length>3?(e(),o("nav",k,[t("div",y,[n.items.prev_page_url?(e(),s(d,{key:1,href:n.items.prev_page_url,class:"border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"},{default:c(()=>[M,N]),_:1},8,["href"])):(e(),o("div",b,j))]),t("div",L,[(e(!0),o(h,null,p(x.links,i=>(e(),o(h,{key:i.label},[i.url?(e(),s(d,{key:0,href:i.url,class:g(["border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium",{"border-green-500 text-green-600":i.active}])},{default:c(()=>[l(w(i.label),1)]),_:2},1032,["href","class"])):(e(),o("span",P," ... "))],64))),128))]),t("div",V,[n.items.next_page_url?(e(),s(d,{key:1,href:n.items.next_page_url,class:"border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"},{default:c(()=>[F,J]),_:1},8,["href"])):(e(),o("div",H,E))])])):f("",!0)}var G=u(v,[["render",O]]);export{G as P,X as a,q as b,A as r};
