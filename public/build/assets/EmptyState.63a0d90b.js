import{o as e,c as m,b as o,_,r as s,J as n,L as i,M as l,a as r,N as a,w as g,d as f}from"./app.9dc34ef4.js";import{B as x}from"./ButtonLink.8dca3e04.js";function v(c,d){return e(),m("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[o("path",{"fill-rule":"evenodd",d:"M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z","clip-rule":"evenodd"})])}const k={components:{PlusIcon:v,ButtonLink:x},props:{heading:String,subtitle:String,buttonText:String,href:String,align:{type:String,default:"center"},showIcon:{type:Boolean,default:!0}}},w=r("path",{"vector-effect":"non-scaling-stroke","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"},null,-1),b=[w],y={class:"text-sm text-gray-700"},B={class:"mt-1 text-sm text-gray-500"},S={key:1,class:"mt-6"};function C(c,d,t,V,I,N){const h=s("PlusIcon"),u=s("button-link");return e(),n("div",{class:i(["p-6",{"text-center":t.align==="center","text-right":t.align==="right","text-left":t.align==="left"}])},[t.showIcon?(e(),n("svg",{key:0,class:i(["mb-2 h-12 w-12 text-gray-400",{"mx-auto":t.align==="center","ml-auto":t.align==="right","mr-auto":t.align==="left"}]),fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","aria-hidden":"true"},b,2)):l("",!0),r("h3",y,a(t.heading),1),r("p",B,a(t.subtitle),1),t.buttonText&&t.href?(e(),n("div",S,[o(u,{href:t.href},{default:g(()=>[o(h,{class:"-ml-1 mr-2 h-5 w-5","aria-hidden":"true"}),f(" "+a(t.buttonText),1)]),_:1},8,["href"])])):l("",!0)],2)}var E=_(k,[["render",C]]);export{E};
