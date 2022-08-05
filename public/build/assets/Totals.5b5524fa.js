import{_ as v,ap as w,r as l,o as h,J as m,b as s,w as o,a as e,M as f,N as p,d as n}from"./app.9dc34ef4.js";import{_ as c}from"./debounce.c1877602.js";const V={components:{MoneyInput:w},props:{order:{type:Object,required:!0}},data(){return{isFocused:!1,updatedOrder:this.$inertia.form({is_taxable:this.order.is_taxable,tax_percentage:this.order.tax_percentage,warranty_percentage:this.order.warranty_percentage,shipping_method_id:this.order.shipping_method_id,shipping_amount:this.order.shipping_amount}),shipping_method:null,shipping_methods:this.$page.props.shipping_methods}},mounted(){var r;this.shipping_method=(r=this.shipping_methods.find(d=>d.id===this.order.shipping_method_id))!=null?r:null},watch:{shipping_method(r){this.updatedOrder.shipping_method_id=r?r.id:null},"updatedOrder.shipping_method_id":c(function(r){this.updateOrder()},500),"updatedOrder.is_taxable":c(function(){this.updateOrder()},500),"updatedOrder.warranty_percentage":c(function(){this.updateOrder()},500),"updatedOrder.tax_percentage":c(function(){this.updateOrder()},500),"updatedOrder.shipping_amount":c(function(){this.updateOrder()},500),order:{handler(r){this.updatedOrder.isDirty||(this.updatedOrder=this.$inertia.form(r))},deep:!0}},methods:{sendQuoteChanges(){this.updatedOrder.patch(route("quotes.update",this.order.id),{errorBag:"updateOrder",preserveScroll:!0})},sendOrderChanges(){this.updatedOrder.patch(route("orders.update",this.order.id),{errorBag:"updateOrder",preserveScroll:!0})},updateOrder(){this.updatedOrder.isDirty&&!this.updatedOrder.processing&&(this.order.is_quote?this.sendQuoteChanges():this.sendOrderChanges())}}},j=n("Shipping / Tax / Totals"),k={class:"md:grid grid-cols-2 gap-8"},T={class:"grid gap-2 items-center"},M={key:0},S={class:"grid grid-cols-2 gap-4 items-center"},C=n("Shipping Amount"),B={class:"grid grid-cols-2 gap-4 items-center"},N=n("Warrany Percentage"),U={class:"grid grid-cols-2 gap-4 items-center border-t mt-2 pt-2"},A={class:"label justify-start"},D=e("span",{class:"label-text"},"Taxable",-1),q={key:1,class:"grid grid-cols-2 gap-4 items-center"},I=n("Tax Percentage"),P={class:"grid gap-2 mt-4 pt-4 border-t md:border-t-0 md:mt-0 md:py-2 items-center"},Q={class:"flex space-x-4 justify-between items-center auto-cols-min"},W=n("Product Total"),E={class:"text-black"},F={class:"flex space-x-4 justify-between items-center"},G=n("Discount Total"),J={class:"text-gray-600"},z={class:"flex space-x-4 justify-between items-center"},H=n("Warranty Amount"),K={class:"text-gray-600"},L={class:"flex space-x-4 justify-between items-center"},R=n("Sub Total"),X={class:"text-black"},Y={class:"flex space-x-4 justify-between items-center"},Z=n("Shipping Amount"),$={class:"text-gray-600"},ee={class:"flex space-x-4 justify-between items-center"},te=n("Tax Amount"),se={class:"text-gray-600"},re={class:"flex space-x-4 justify-between uppercase items-center border-t pt-2"},de=n("Grand Total"),oe={class:"text-black text-lg"};function ne(r,d,_,ae,t,ie){const x=l("jet-section-title"),y=l("select-box"),a=l("jet-label"),O=l("money-input"),u=l("jet-input-error"),g=l("percentage-input"),b=l("jet-checkbox");return h(),m("div",null,[s(x,null,{title:o(()=>[j]),_:1}),e("div",k,[e("div",T,[t.updatedOrder.processing?(h(),m("p",M,"Saving...")):f("",!0),s(y,{labelValue:"Shipping Method",modelValue:t.shipping_method,"onUpdate:modelValue":d[0]||(d[0]=i=>t.shipping_method=i),selectedItem:t.shipping_method,items:t.shipping_methods,id:"shipping_method"},null,8,["modelValue","selectedItem","items"]),e("div",S,[s(a,{for:"shipping_amount"},{default:o(()=>[C]),_:1}),s(O,{modelValue:t.updatedOrder.shipping_amount,"onUpdate:modelValue":d[1]||(d[1]=i=>t.updatedOrder.shipping_amount=i),id:"shipping_amount"},null,8,["modelValue"]),s(u,{class:"col-span-2",message:t.updatedOrder.errors.shipping_amount},null,8,["message"])]),e("div",B,[s(a,{for:"warranty_percentage"},{default:o(()=>[N]),_:1}),s(g,{id:"warranty_percentage",modelValue:t.updatedOrder.warranty_percentage,"onUpdate:modelValue":d[2]||(d[2]=i=>t.updatedOrder.warranty_percentage=i)},null,8,["modelValue"]),s(u,{class:"col-span-2",message:t.updatedOrder.errors.warranty_percentage},null,8,["message"])]),e("div",U,[e("label",A,[s(b,{class:"mr-2",checked:t.updatedOrder.is_taxable,modelValue:t.updatedOrder.is_taxable,"onUpdate:modelValue":d[3]||(d[3]=i=>t.updatedOrder.is_taxable=i)},null,8,["checked","modelValue"]),D])]),t.updatedOrder.is_taxable?(h(),m("div",q,[s(a,{for:"tax_percentage"},{default:o(()=>[I]),_:1}),s(g,{id:"tax_percentage",modelValue:t.updatedOrder.tax_percentage,"onUpdate:modelValue":d[4]||(d[4]=i=>t.updatedOrder.tax_percentage=i)},null,8,["modelValue"]),s(u,{class:"col-span-2",message:t.updatedOrder.errors.tax_percentage},null,8,["message"])])):f("",!0)]),e("div",P,[e("div",Q,[s(a,null,{default:o(()=>[W]),_:1}),e("p",E,p(r.formatMoney(_.order.total)),1)]),e("div",F,[s(a,null,{default:o(()=>[G]),_:1}),e("p",J,p(r.formatMoney(_.order.total_discounts)),1)]),e("div",z,[s(a,null,{default:o(()=>[H]),_:1}),e("p",K,p(r.formatMoney(_.order.warranty_amount)),1)]),e("div",L,[s(a,{class:"text-black"},{default:o(()=>[R]),_:1}),e("p",X,p(r.formatMoney(_.order.total_after_discount_and_warranty)),1)]),e("div",Y,[s(a,null,{default:o(()=>[Z]),_:1}),e("p",$,p(r.formatMoney(t.updatedOrder.shipping_amount)),1)]),e("div",ee,[s(a,null,{default:o(()=>[te]),_:1}),e("p",se,p(r.formatMoney(_.order.tax_amount)),1)]),e("div",re,[s(a,{class:"text-black text-lg"},{default:o(()=>[de]),_:1}),e("p",oe,p(r.formatMoney(_.order.grand_total)),1)])])])])}var _e=v(V,[["render",ne]]);export{_e as default};
