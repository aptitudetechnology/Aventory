import{r as l,a as _}from"./Pagination.3363932c.js";import{r as u}from"./ExternalLinkIcon.f42ffed2.js";import f from"./QuotesLayout.a19ac898.js";import{B as g}from"./ButtonLink.8dca3e04.js";import{_ as h,Y as w,r as e,o as y,c as x,w as t,a as r,b as o,d as n}from"./app.9dc34ef4.js";import{H as v}from"./HeadingOne.438448cb.js";import b from"./CompletedOrdersCard.4c50f7c4.js";import C from"./ActiveQuotesCard.132c6d55.js";import k from"./OrdersView.3139794d.js";import"./AppLayout.61f6b15f.js";import"./use-tree-walker.esm.e2024782.js";import"./description.esm.f365edce.js";import"./BackLink.7902487f.js";import"./ChevronLeftIcon.49588678.js";import"./MainArea.46d7601f.js";import"./TableTable.3ade9a0a.js";import"./TableHead.013de464.js";import"./TableH.0f53360f.js";import"./TableD.bf7ad4fd.js";import"./SearchInput.e0ea6baa.js";import"./debounce.c1877602.js";const q={components:{ExternalLinkIcon:u,ArrowDownIcon:l,ArrowUpIcon:_,QuotesLayout:f,ButtonLink:g,DetailsSection:w,HeadingOne:v,CompletedOrdersCard:b,ActiveQuotesCard:C,ViewOrders:k},props:{quotes:{type:Object},filters:{type:Object}}},O={class:"flex justify-between items-center w-full pb-9 px-2 lg:px-4"},B=n("Quotes"),D=n("New Quote"),I={class:"grid gap-6 lg:gap-8"},N={class:"grid gap-4 lg:gap-6 md:grid-cols-3 text-gray-900"};function Q(i,V,s,$,j,A){const a=e("heading-one"),d=e("button-link"),p=e("completed-orders-card"),c=e("view-orders"),m=e("quotes-layout");return y(),x(m,null,{default:t(()=>[r("div",O,[o(a,null,{default:t(()=>[B]),_:1}),o(d,{href:i.route("quotes.create")},{default:t(()=>[D]),_:1},8,["href"])]),r("div",I,[r("div",N,[o(p,{thirtyDaysCompletedOrders:0,thirtyDaysCompletedSales:0})]),o(c,{"are-quotes":!0,orders:s.quotes,filters:s.filters},null,8,["orders","filters"])])]),_:1})}var re=h(q,[["render",Q]]);export{re as default};