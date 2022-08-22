import{A as h}from"./AppLayout.00f0692d.js";import{C as L}from"./Card.c8554ad6.js";import{M as g}from"./MainArea.7670109e.js";import x from"./SearchInventory.5d80dcfb.js";import A from"./InventorySizeUpdate.7f5c275d.js";import N from"./InventoryQuantityUpdate.fa6f8468.js";import I from"./InventoryLocationUpdate.6ca6bb79.js";import z from"./ReprintTag.52e6cbe1.js";import{_ as C,r as e,o as c,c as S,w as i,b as o,a as n,N as a,d as w,J as M,L as k,M as B}from"./app.123e766a.js";import"./use-tree-walker.esm.615d46a4.js";import"./description.esm.8bb4746d.js";import"./SearchInput.993ac6a1.js";import"./PencilIcon.8d9e916b.js";import"./DialogModal.11efde9a.js";import"./Modal.c06c0ace.js";import"./ConfirmationModal.82dd7e96.js";import"./PrintButton.7e204590.js";import"./ErrorMessage.9555be26.js";import"./XCircleIcon.401ddebd.js";const T={components:{AppLayout:h,Card:L,MainArea:g,SearchInventory:x,InventorySizeUpdate:A,InventoryQuantityUpdate:N,InventoryLocationUpdate:I,ReprintTag:z},props:{inventory:Object,sizes:Array},data(){return{autoLocateNotice:{wasAutoLocated:!1,message:null}}},unmounted(){localStorage.lastInventoryId=this.inventory.id},methods:{updateLocatedNotice(s){this.autoLocateNotice=s}}},V={class:"mt-6 grid divide-y divide-gray-100"},b={class:"py-4"},R={class:"text-xl"},U={class:"text-lg"},q={class:"text-green-600"},O={class:"py-4"};function j(s,D,t,E,r,d){const m=e("SearchInventory"),p=e("inventory-quantity-update"),_=e("inventory-size-update"),l=e("inventory-location-update"),y=e("ReprintTag"),u=e("Card"),v=e("MainArea"),f=e("AppLayout");return c(),S(f,null,{default:i(()=>[o(v,{dontShowOnMobile:!1},{default:i(()=>[o(u,{class:"max-w-screen-sm"},{default:i(()=>[o(m),n("div",V,[n("div",b,[n("h1",R,a(t.inventory.product.name),1),n("p",U,[w(a(t.inventory.type=="group"?"Group ":"Plant ")+"#: ",1),n("span",q,a(t.inventory.id),1)]),r.autoLocateNotice.message?(c(),M("p",{key:0,class:k([r.autoLocateNotice.wasAutoLocated?"text-green-600":"text-red-500","mt-2"])},a(r.autoLocateNotice.message),3)):B("",!0)]),o(p,{inventory:t.inventory},null,8,["inventory"]),o(_,{sizes:t.sizes,inventory:t.inventory},null,8,["sizes","inventory"]),o(l,{inventory:t.inventory,onAutolocated:d.updateLocatedNotice},null,8,["inventory","onAutolocated"]),n("p",O," Last Inventoried: "+a(t.inventory.last_inventory_date),1),o(y,{inventory:t.inventory},null,8,["inventory"])])]),_:1})]),_:1})]),_:1})}var st=C(T,[["render",j]]);export{st as default};
