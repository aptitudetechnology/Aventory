import _ from"./UpdatePrice.b0cf605a.js";import{T as p}from"./TableH.0f53360f.js";import{_ as m,r as c,o as a,J as n,a as d,b as t,w as o,W as u,X as f,M as h,c as y,d as r}from"./app.9dc34ef4.js";import"./DeletePrice.39ab354f.js";import"./ConfirmationModal.47b3bac6.js";import"./Modal.c8b704a0.js";import"./TrashIcon.e8c48c8a.js";const b={components:{UpdatePrice:_,TableH:p},props:{prices:Array}},v={key:0,class:"min-w-full divide-y divide-gray-200"},g={class:"bg-gray-50"},T=r(" Size "),k=r(" Unit Price "),x=r(" Show in availability "),P={class:"divide-y divide-gray-200 mt-4"};function w(B,N,s,U,V,C){const e=c("TableH"),l=c("UpdatePrice");return s.prices.length?(a(),n("table",v,[d("thead",g,[t(e,null,{default:o(()=>[T]),_:1}),t(e,null,{default:o(()=>[k]),_:1}),t(e,null,{default:o(()=>[x]),_:1}),t(e)]),d("tbody",P,[(a(!0),n(u,null,f(s.prices,i=>(a(),y(l,{key:i.id,price:i},null,8,["price"]))),128))])])):h("",!0)}var J=m(b,[["render",w]]);export{J as default};
