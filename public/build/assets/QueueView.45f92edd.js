import{r as P,a as T,b as D,P as V}from"./Pagination.0188b1db.js";import{_ as N,Y as j,r as o,o as i,c,w as t,P as A,b as n,a as u,J as p,X as C,W as Q,M as y,d as s}from"./app.fbac1591.js";import{T as L}from"./TableTable.fe11040b.js";import{T as q}from"./TableHead.904a962f.js";import{T as H}from"./TableH.0afd0d3c.js";import R from"./ReprintTagsButton.74e7b88d.js";import{S as E}from"./SearchInput.2b0acd82.js";import{_ as O}from"./debounce.210fe42d.js";import U from"./QueueItem.55fa6603.js";import{B as z}from"./ButtonLink.b5238133.js";import"./PrintButton.b548a611.js";import"./TableD.c0eff561.js";const F={components:{ExternalLinkIcon:P,ArrowDownIcon:T,ArrowUpIcon:D,DetailsSection:j,TableTable:L,TableHead:q,TableH:H,ReprintTagsButton:R,SearchInput:E,Pagination:V,QueueItem:U,ButtonLink:z},props:{inventory:{type:Object},filters:{type:Object}},data(){var e;return{allSelected:!1,selected:[],search:this.filters.search||"",orderBy:this.filters.orderBy||"",orderByDirection:(e=this.filters.orderByDirection)!=null?e:"desc"}},computed:{itemsToPrint(){return this.inventory.data.filter(e=>this.selected.includes(e.id))}},watch:{selected:{handler(){this.allSelected=this.selected.length===this.inventory.data.length},deep:!0},search:O(function(e){this.updateSearch()},300)},methods:{toggleAllSelected(){this.allSelected=!this.allSelected,this.selected=this.allSelected?this.inventory.data.map(e=>e.id):[]},toggleSelected(e){this.selected.includes(e.id)?this.selected=this.selected.filter(h=>h!==e.id):this.selected.push(e.id)},isItemSelected(e){return this.selected.includes(e.id)},updateItemBy(e){this.orderBy===e?this.orderByDirection=this.orderByDirection==="desc"?"asc":"desc":(this.orderBy=e,this.orderByDirection="desc"),this.updateSearch()},updateSearch(){this.$inertia.get(this.route("reprint-queue.index"),{search:this.search,orderBy:this.orderBy,orderByDirection:this.orderByDirection,includePrinted:this.filters.includePrinted},{preserveState:!0,replace:!0})},showItem(e){this.$inertia.get(route("inventory.show",e))}}},J=s("Inventory"),M={class:"flex pb-4 space-x-4"},W=s(" Hide Printed"),X=s(" Show Printed"),Y={class:"col-span-6 overflow-auto"},G=s("Select all"),K=s("Inventory ID"),Z=s("Qty to Print"),$=s("Date Added"),ee=s("Product Name"),te=s("Size"),ne=s("Nursery Location"),oe=s("Block"),se={key:0,class:"p-4"},le=u("div",{class:"text-gray-500"},"No Inventory found.",-1),ie=[le];function re(e,h,r,de,d,m){const b=o("search-input"),f=o("button-link"),S=o("ReprintTagsButton"),g=o("jet-label"),v=o("jet-checkbox"),l=o("table-h"),B=o("table-head"),k=o("QueueItem"),I=o("table-table"),w=o("pagination"),x=o("details-section");return i(),c(x,null,{title:t(()=>[A(e.$slots,"title",{},()=>[J])]),aside:t(()=>[n(b,{modelValue:d.search,"onUpdate:modelValue":h[0]||(h[0]=_=>d.search=_)},null,8,["modelValue"])]),default:t(()=>{var _;return[u("div",M,[r.filters.includePrinted?(i(),c(f,{key:0,href:e.route("reprint-queue.index"),class:"btn btn-sm"},{default:t(()=>[W]),_:1},8,["href"])):(i(),c(f,{key:1,href:e.route("reprint-queue.index",{includePrinted:!0}),class:"btn btn-sm"},{default:t(()=>[X]),_:1},8,["href"])),n(S,{disabled:!d.selected.length,inventory:d.selected},null,8,["disabled","inventory"])]),u("div",Y,[n(I,{class:"text-left"},{default:t(()=>[n(B,null,{default:t(()=>[n(l,{class:"sticky left-0 bg-white"},{default:t(()=>[u("div",null,[n(g,{class:"sr-only",for:"select-all"},{default:t(()=>[G]),_:1}),n(v,{id:"select-all",checked:d.allSelected,onChange:m.toggleAllSelected},null,8,["checked","onChange"])])]),_:1}),n(l,null,{default:t(()=>[K]),_:1}),n(l,null,{default:t(()=>[Z]),_:1}),n(l,null,{default:t(()=>[$]),_:1}),n(l,null,{default:t(()=>[ee]),_:1}),n(l,null,{default:t(()=>[te]),_:1}),n(l,null,{default:t(()=>[ne]),_:1}),n(l,null,{default:t(()=>[oe]),_:1})]),_:1}),u("tbody",null,[(i(!0),p(Q,null,C(r.inventory.data,a=>(i(),c(k,{key:`${a.id}-${a.pivot.created_at}`,item:a,itemSelected:m.isItemSelected(a),onSelected:ae=>m.toggleSelected(a)},null,8,["item","itemSelected","onSelected"]))),128))])]),_:1}),((_=r.inventory.data)==null?void 0:_.length)<1?(i(),p("div",se,ie)):y("",!0),r.inventory.data?(i(),c(w,{key:1,items:r.inventory},null,8,["items"])):y("",!0)])]}),_:3})}var Be=N(F,[["render",re]]);export{Be as default};
