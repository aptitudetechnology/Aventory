import{r as g,a as S,P as T}from"./Pagination.3363932c.js";import{r as x}from"./ExternalLinkIcon.f42ffed2.js";import{_ as V,Y as N,r as s,o as c,c as y,w as e,P as C,b as t,a as m,J as h,X as P,d as r,N as _,W as A,M as b}from"./app.9dc34ef4.js";import{T as L}from"./TableTable.3ade9a0a.js";import{T as $}from"./TableHead.013de464.js";import{T as j}from"./TableH.0f53360f.js";import{T as z}from"./TableD.bf7ad4fd.js";import{S as E}from"./SearchInput.e0ea6baa.js";import{_ as H}from"./debounce.c1877602.js";const O={components:{ExternalLinkIcon:x,ArrowDownIcon:g,ArrowUpIcon:S,DetailsSection:N,TableTable:L,TableHead:$,TableH:j,TableD:z,SearchInput:E,Pagination:T},props:{inventory:{type:Object},filters:{type:Object}},data(){var o,i,n;return{search:((o=this.filters)==null?void 0:o.search)||"",orderBy:((i=this.filters)==null?void 0:i.orderBy)||"",orderByDirection:((n=this.filters)==null?void 0:n.orderByDirection)||""}},watch:{search:H(function(o){this.updateSearch()},300)},methods:{updateItemBy(o){this.orderBy===o?this.orderByDirection=this.orderByDirection==="desc"?"asc":"desc":(this.orderBy=o,this.orderByDirection="desc"),this.updateSearch()},updateSearch(){this.$inertia.get(this.route("inventory.index"),{search:this.search,orderBy:this.orderBy,orderByDirection:this.orderByDirection},{preserveState:!0,replace:!0})},showItem(o){this.$inertia.get(route("inventory.show",o))}}},U=r("Inventory"),F={class:"col-span-6 overflow-auto"},J=r("Inventory ID"),M=r("Date Added"),W=r("Product Name"),X=r("Size"),Y=r("Block Location"),q=["onClick"],G={key:0,class:"p-4"},K=m("div",{class:"text-gray-500"},"No Inventory found.",-1),Q=[K];function R(o,i,n,Z,p,v){const B=s("search-input"),l=s("table-h"),D=s("table-head"),d=s("table-d"),k=s("table-table"),I=s("pagination"),w=s("details-section");return c(),y(w,null,{title:e(()=>[C(o.$slots,"title",{},()=>[U])]),aside:e(()=>[t(B,{modelValue:p.search,"onUpdate:modelValue":i[0]||(i[0]=u=>p.search=u)},null,8,["modelValue"])]),default:e(()=>{var u,f;return[m("div",F,[t(k,{class:"text-left"},{default:e(()=>[t(D,null,{default:e(()=>[t(l,null,{default:e(()=>[J]),_:1}),t(l,null,{default:e(()=>[M]),_:1}),t(l,null,{default:e(()=>[W]),_:1}),t(l,null,{default:e(()=>[X]),_:1}),t(l,null,{default:e(()=>[Y]),_:1})]),_:1}),m("tbody",null,[(c(!0),h(A,null,P(n.inventory.data,a=>(c(),h("tr",{key:a.id,tabindex:"0",class:"px-2 border-b border-gray-50 last:border-transparent hover:border-black focus:border-black transition cursor-pointer",onClick:ee=>v.showItem(a)},[t(d,null,{default:e(()=>[r(_(a.id),1)]),_:2},1024),t(d,null,{default:e(()=>[r(_(o.formatDate(a.created_at)),1)]),_:2},1024),t(d,null,{default:e(()=>[r(_(a.product_name),1)]),_:2},1024),t(d,null,{default:e(()=>[r(_(a.size_name),1)]),_:2},1024),t(d,null,{default:e(()=>[r(_(a.block.name),1)]),_:2},1024)],8,q))),128))])]),_:1}),((f=(u=n.inventory)==null?void 0:u.data)==null?void 0:f.length)<1?(c(),h("div",G,Q)):b("",!0),n.inventory.data?(c(),y(I,{key:1,items:n.inventory},null,8,["items"])):b("",!0)])]}),_:3})}var ce=V(O,[["render",R]]);export{ce as default};
