import{_ as h,a0 as f,a2 as b,a4 as w,a5 as x,a3 as v,r as o,o as y,J as P,a as t,N as n,b as i,w as j,d as k}from"./app.123e766a.js";import C from"./DeletePrice.dcdfee4d.js";import"./ConfirmationModal.82dd7e96.js";import"./Modal.c06c0ace.js";import"./TrashIcon.22389a9d.js";const J={components:{JetButton:f,JetInput:b,JetInputError:w,JetLabel:x,JetCheckbox:v,DeletePrice:C},props:{price:Object},data(){return{form:this.$inertia.form({_method:"PATCH",product_id:this.price.product_id,size_id:this.price.size_id,unit_price:this.price.unit_price,custom_price:this.price.custom_price,show_on_availability:this.price.show_on_availability})}},methods:{updateProductPrice(){this.form.patch(route("prices.update",this.price),{preserveScroll:!0,preserveState:!0})}}},V={class:"px-6 py-4 whitespace-nowrap text-gray-900"},g={class:"px-6 py-4 whitespace-nowrap"},B={class:"mt-1 relative max-w-xs rounded-md shadow-sm"},N=t("div",{class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"}," $ ",-1),D={class:"px-6 py-4 whitespace-nowrap"},U={class:"flex space-x-4"},z={class:"px-6 py-4 whitespace-nowrap"};function L(S,r,s,E,e,c){const l=o("jet-label"),p=o("jet-input"),_=o("jet-input-error"),d=o("jet-checkbox"),u=o("JetLabel"),m=o("DeletePrice");return y(),P("tr",null,[t("td",V,n(s.price.size.name),1),t("td",g,[i(l,{for:"unit_price",class:"sr-only",value:"Unit Price"}),t("div",B,[N,i(p,{onChange:c.updateProductPrice,id:"unit_price",type:"number",step:"0.01",class:"block w-full pl-6",modelValue:e.form.unit_price,"onUpdate:modelValue":r[0]||(r[0]=a=>e.form.unit_price=a),required:""},null,8,["onChange","modelValue"])]),i(_,{message:e.form.errors.unit_price,class:"mt-2"},null,8,["message"])]),t("td",D,[t("div",U,[i(d,{onChange:c.updateProductPrice,modelValue:e.form.show_on_availability,"onUpdate:modelValue":r[1]||(r[1]=a=>e.form.show_on_availability=a),checked:e.form.show_on_availability,id:"show_on_availability"+s.price.id},null,8,["onChange","modelValue","checked","id"]),i(u,{for:"show_on_availability"+s.price.id},{default:j(()=>[k(n(e.form.show_on_availability?"Yes":"No"),1)]),_:1},8,["for"])])]),t("td",z,[i(m,{price:s.price},null,8,["price"])])])}var O=h(J,[["render",L]]);export{O as default};
