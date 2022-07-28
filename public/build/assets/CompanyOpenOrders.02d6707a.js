import{V as y,r as d,o as e,t as o,b as _,w as a,c as i,F as h,D as m,a as l,x as f,d as g}from"./app.c6d51eb6.js";import{D as k}from"./DetailsSection.5647e5ed.js";import{E as w}from"./EmptyState.299ed1ff.js";import{L as O}from"./LoadingState.36d08ac8.js";import{_ as x}from"./plugin-vue_export-helper.21dcd24c.js";import"./SectionTitle.6e9e4bb1.js";import"./ButtonLink.a3a01f7d.js";const q={components:{DetailsSection:k,EmptyState:w,LoadingState:O},props:{customer:{type:Object,required:!1}},data(){return{loading:!1,orders:[],quotes:[]}},watch:{customer(){this.getOrders()}},mounted(){this.getOrders()},methods:{getOrders(){var t;this.loading=!0,y.get(route("api.sales.index",{customer:(t=this.customer)==null?void 0:t.id})).then(n=>{this.orders=n.data.orders,this.quotes=n.data.quotes}).catch(n=>{console.error(n.message)}).finally(()=>{this.loading=!1})},showOrder(t){this.showPopup(route(t.route,t.id))}}},v={class:"space-y-4"},b=g("Customer Orders"),V={key:2,class:"max-h-52 overflow-y-auto"},C=["href"],N=l("span",{class:"link"},"View",-1),B=g("Customer Quotes"),D={key:2,class:"max-h-52 overflow-y-auto"},S=["href"],j=l("span",{class:"link"},"View",-1);function E(t,n,L,F,s,I){const c=d("loading-state"),u=d("empty-state"),p=d("details-section");return e(),o("div",v,[_(p,null,{title:a(()=>[b]),default:a(()=>[s.loading?(e(),i(c,{key:0,loading:s.loading},null,8,["loading"])):s.orders.length?(e(),o("div",V,[(e(!0),o(h,null,m(s.orders,r=>(e(),o("a",{key:"order.id",class:"flex items-center justify-between py-2",href:t.route("orders.show",r.id),target:"_blank"},[l("span",null,f(r.full_name),1),N],8,C))),128))])):(e(),i(u,{key:1,heading:"No Open Orders",showIcon:!1,align:"left",class:"p-0"}))]),_:1}),_(p,null,{title:a(()=>[B]),default:a(()=>[s.loading?(e(),i(c,{key:0,loading:s.loading},null,8,["loading"])):s.quotes.length?(e(),o("div",D,[(e(!0),o(h,null,m(s.quotes,r=>(e(),o("a",{key:"order.id",class:"flex items-center justify-between py-2",href:t.route("quotes.show",r.id),target:"_blank"},[l("span",null,f(r.full_name),1),j],8,S))),128))])):(e(),i(u,{key:1,heading:"No Open Quotes",showIcon:!1,align:"left",class:"p-0"}))]),_:1})])}var J=x(q,[["render",E]]);export{J as default};
