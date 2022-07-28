import{B as v}from"./ButtonLink.a3a01f7d.js";import{T as L,a as S}from"./TabLink.ac542be0.js";import{S as x}from"./SearchInput.8d98e40e.js";import{P as N,A as V}from"./AsideLink.57c8023d.js";import{E as C}from"./EmptyState.299ed1ff.js";import{S as B}from"./SectionTitle.6e9e4bb1.js";import{_ as T}from"./plugin-vue_export-helper.21dcd24c.js";import{r as n,o as c,c as _,w as r,b as p,M as A,d as i,x as u,v as m,a as s,t as f,D,F as E}from"./app.c6d51eb6.js";import"./Input.3e59ac9d.js";const I={components:{PageAside:N,AsideLink:V,ButtonLink:v,TabContainer:L,TabLink:S,SearchInput:x,EmptyState:C,JetSectionTitle:B},props:{purchases:Array},computed:{purchasesLength:function(){return this.purchases.length}},data(){return{search:"",filteredPurchases:this.purchases}},methods:{updatePurchases(){this.filteredPurchases=this.purchases.filter(e=>{var d,h;let a=this.search.toLowerCase();return!!(e.vendor_name.toLowerCase().includes(a)||((d=e.date)==null?void 0:d.includes(a))||((h=e.order_number)==null?void 0:h.toLowerCase().includes(a)))})}}},M=i("Purchases"),j=i("New Purchase"),F={class:"bg-white"},O={class:"divide-y divide-gray-200"},G={class:"flex-1 min-w-0"},J={class:"focus:outline-none"},U=s("span",{class:"absolute inset-0","aria-hidden":"true"},null,-1),q={class:"text-sm text-gray-900"},z=s("b",{class:"font-bold"},"Vendor: ",-1),H={key:0,class:"text-sm text-gray-900 truncate"},K=s("b",{class:"font-bold"},"Purchase Number: ",-1),Q={class:"text-sm text-gray-900 truncate"},R=s("b",{class:"font-bold"},"Purchase Date: ",-1);function W(e,a,d,h,l,o){const b=n("button-link"),g=n("jet-section-title"),w=n("search-input"),y=n("aside-link"),P=n("empty-state"),k=n("page-aside");return c(),_(k,{showOnMobile:e.route().current("purchases.index")},{header:r(()=>[p(g,null,A({title:r(()=>[M]),aside:r(()=>[p(b,{href:e.route("purchases.create")},{default:r(()=>[j]),_:1},8,["href"])]),_:2},[o.purchasesLength>0?{name:"description",fn:r(()=>[i("Search "+u(o.purchasesLength)+" "+u(o.purchasesLength>1?"Purchases":"Purchase"),1)])}:void 0]),1024),o.purchasesLength>0?(c(),_(w,{key:0,modelValue:l.search,"onUpdate:modelValue":a[0]||(a[0]=t=>l.search=t),onInput:o.updatePurchases,placeholder:"Search by purchase number, vendor, or date."},null,8,["modelValue","onInput"])):m("",!0)]),default:r(()=>[s("div",F,[s("ul",O,[(c(!0),f(E,null,D(l.filteredPurchases,t=>(c(),f("li",{key:t.id,class:"bg-white"},[p(y,{href:t.deleted_at?e.route("archived-purchases.show",t.id):e.route("purchases.show",t.id),current:e.route().current("purchases.show",t.id)||e.route().current("archived-purchases.show",t.id)},{default:r(()=>[s("div",G,[s("div",J,[U,s("p",q,[z,i(u(t.vendor.name),1)]),t.purchase_number?(c(),f("p",H,[K,i(u(t.order_number),1)])):m("",!0),s("p",Q,[R,i(u(new Date(t.date).toDateString()),1)])])])]),_:2},1032,["href","current"])]))),128))])]),o.purchasesLength<1&&e.route().current("purchases.index")?(c(),_(P,{key:0,heading:"No Purchases",subtitle:"Get started by creating a new purchase.","button-text":"New Purchase",href:e.route("purchases.create")},null,8,["href"])):m("",!0)]),_:1},8,["showOnMobile"])}var oe=T(I,[["render",W]]);export{oe as default};
