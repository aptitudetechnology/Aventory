import{r as l,a as _}from"./Pagination.af7f5277.js";import{r as u}from"./ExternalLinkIcon.59cc0665.js";import f from"./QuotesLayout.7c954242.js";import{B as g}from"./ButtonLink.a3a01f7d.js";import{D as h}from"./DetailsSection.5647e5ed.js";import{H as w}from"./HeadingOne.120414f6.js";import y from"./CompletedOrdersCard.6a88a1d5.js";import x from"./ActiveQuotesCard.e0c9d78d.js";import v from"./OrdersView.b8ea4274.js";import{_ as b}from"./plugin-vue_export-helper.21dcd24c.js";import{r as o,o as C,c as k,w as e,a as r,b as t,d as i}from"./app.c6d51eb6.js";import"./AppLayout.fc980c7c.js";import"./dom.esm.fa0fef86.js";import"./calculate-active-index.esm.611fafbc.js";import"./use-resolve-button-type.esm.4623ef0e.js";import"./use-tree-walker.esm.683d9237.js";import"./description.esm.62a21e39.js";import"./BackLink.a8ed3402.js";import"./ChevronLeftIcon.644abc42.js";import"./MainArea.debbbb70.js";import"./SectionTitle.6e9e4bb1.js";import"./TableTable.57c1791a.js";import"./TableHead.02c9ad7d.js";import"./TableH.0d8a0dd9.js";import"./TableD.547be9db.js";import"./SearchInput.8d98e40e.js";import"./Input.3e59ac9d.js";import"./debounce.99af33cc.js";import"./moment.9709ab41.js";const q={components:{ExternalLinkIcon:u,ArrowDownIcon:l,ArrowUpIcon:_,QuotesLayout:f,ButtonLink:g,DetailsSection:h,HeadingOne:w,CompletedOrdersCard:y,ActiveQuotesCard:x,ViewOrders:v},props:{quotes:{type:Object},filters:{type:Object}}},O={class:"flex justify-between items-center w-full pb-9 px-2 lg:px-4"},B=i("Quotes"),D=i("New Quote"),I={class:"grid gap-6 lg:gap-8"},N={class:"grid gap-4 lg:gap-6 md:grid-cols-3 text-gray-900"};function Q(n,V,s,$,j,A){const a=o("heading-one"),p=o("button-link"),m=o("completed-orders-card"),d=o("view-orders"),c=o("quotes-layout");return C(),k(c,null,{default:e(()=>[r("div",O,[t(a,null,{default:e(()=>[B]),_:1}),t(p,{href:n.route("quotes.create")},{default:e(()=>[D]),_:1},8,["href"])]),r("div",I,[r("div",N,[t(m,{thirtyDaysCompletedOrders:0,thirtyDaysCompletedSales:0})]),t(d,{"are-quotes":!0,orders:s.quotes,filters:s.filters},null,8,["orders","filters"])])]),_:1})}var lo=b(q,[["render",Q]]);export{lo as default};
