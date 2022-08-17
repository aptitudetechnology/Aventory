import{r as g,a as C,P as T}from"./Pagination.93041d99.js";import{r as S}from"./ExternalLinkIcon.da9b6267.js";import{_ as I,Y as P,ao as V,r as n,o,c as l,w as r,P as A,d as i,N as h,b as s,a as d,L as B,J as b,X as N,W as O,M as Y}from"./app.9a96a844.js";import{T as U}from"./TableTable.8f60fbf0.js";import{T as L}from"./TableHead.31d4a73d.js";import{T as M}from"./TableH.566f7ac6.js";import{T as j}from"./TableD.28767d14.js";import{S as E}from"./SearchInput.954adf21.js";import{_ as H}from"./debounce.b869029f.js";const z={components:{ExternalLinkIcon:S,ArrowDownIcon:g,ArrowUpIcon:C,DetailsSection:P,TableTable:U,TableHead:L,TableH:M,TableD:j,SearchInput:E,Pagination:T},props:{purchases:{type:Object},filters:{type:Object}},data(){return{search:this.filters.search||"",orderBy:this.filters.orderBy||"",orderByDirection:this.filters.orderByDirection||""}},watch:{search:H(function(a){this.updateSearch()},200)},methods:{formatDate:a=>V(a).format("MM/DD/YYYY"),updateOrderBy(a){this.orderBy===a?this.orderByDirection=this.orderByDirection==="desc"?"asc":"desc":(this.orderBy=a,this.orderByDirection="desc"),this.updateSearch()},updateSearch(){this.$inertia.get(this.route("purchases.index"),{search:this.search,orderBy:this.orderBy,orderByDirection:this.orderByDirection},{preserveState:!0,replace:!0})},showPurchase(a){}}},F={class:"col-span-6 overflow-auto"},J=i(" Purchase # "),R=i(" Date "),W=i(" Customer "),X=["onClick"],q={key:0,class:"p-4"},G={class:"text-gray-500"};function K(a,c,m,Q,e,u){const w=n("search-input"),p=n("ArrowUpIcon"),_=n("ArrowDownIcon"),y=n("table-h"),D=n("table-head"),f=n("table-d"),k=n("table-table"),v=n("pagination"),x=n("details-section");return o(),l(x,null,{title:r(()=>[A(a.$slots,"title",{},()=>[i("Recent Purchases "+h(e.search?"for "+e.search:""),1)])]),aside:r(()=>[s(w,{modelValue:e.search,"onUpdate:modelValue":c[0]||(c[0]=t=>e.search=t)},null,8,["modelValue"])]),default:r(()=>[d("div",F,[s(k,{class:"text-left"},{default:r(()=>[s(D,null,{default:r(()=>[s(y,null,{default:r(()=>[d("div",{class:B(["select-none cursor-pointer flex items-center",e.orderBy=="id"?"text-gray-900":""]),onClick:c[1]||(c[1]=t=>u.updateOrderBy("id"))},[J,e.orderBy=="id"&&e.orderByDirection=="asc"?(o(),l(p,{key:0,class:"ml-2 w-3 h-3"})):(o(),l(_,{key:1,class:"ml-2 w-3 h-3"}))],2)]),_:1}),s(y,null,{default:r(()=>[d("div",{class:B(["select-none cursor-pointer flex items-center",e.orderBy=="date"?"text-gray-900":""]),onClick:c[2]||(c[2]=t=>u.updateOrderBy("date"))},[R,e.orderBy=="date"&&e.orderByDirection=="asc"?(o(),l(p,{key:0,class:"ml-2 w-3 h-3"})):(o(),l(_,{key:1,class:"ml-2 w-3 h-3"}))],2)]),_:1}),s(y,null,{default:r(()=>[d("div",{class:B(["select-none cursor-pointer flex items-center",e.orderBy=="vendor"?"text-gray-900":""]),onClick:c[3]||(c[3]=t=>u.updateOrderBy("vendor"))},[W,e.orderBy=="vendor"&&e.orderByDirection=="asc"?(o(),l(p,{key:0,class:"ml-2 w-3 h-3"})):(o(),l(_,{key:1,class:"ml-2 w-3 h-3"}))],2)]),_:1})]),_:1}),d("tbody",null,[(o(!0),b(O,null,N(m.purchases.data,t=>(o(),b("tr",{key:t.id,tabindex:"0",class:"px-2 border-b border-gray-50 last:border-transparent hover:border-black focus:border-black transition cursor-pointer",onClick:Z=>u.showPurchase(t)},[s(f,null,{default:r(()=>[i(h(t.id),1)]),_:2},1024),s(f,null,{default:r(()=>[i(h(u.formatDate(t.date)),1)]),_:2},1024),s(f,null,{default:r(()=>[i(h(t.vendor.name),1)]),_:2},1024)],8,X))),128))])]),_:1}),m.purchases.data.length<1?(o(),b("div",q,[d("div",G," No purchases found "+h(e.search?" for "+e.search:"")+". ",1)])):Y("",!0),s(v,{items:m.purchases},null,8,["items"])])]),_:3})}var le=I(z,[["render",K]]);export{le as default};
