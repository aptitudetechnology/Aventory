import{A as h}from"./AppLayout.3304023d.js";import{C as L}from"./Card.4da7d259.js";import{M as g}from"./MainArea.def08b37.js";import x from"./SearchInventory.42f7ae64.js";import A from"./InventorySizeUpdate.59ad4069.js";import N from"./InventoryQuantityUpdate.ae58b922.js";import I from"./InventoryLocationUpdate.027ada8d.js";import z from"./ReprintTag.a8491921.js";import{_ as C,r as e,o as c,c as S,w as i,b as o,a as n,N as a,d as w,J as M,L as k,M as B}from"./app.fa9cc1ae.js";import"./use-tree-walker.esm.46f3148c.js";import"./description.esm.1831666a.js";import"./SearchInput.afb6d862.js";import"./PencilIcon.8057c110.js";import"./DialogModal.ea7b6519.js";import"./Modal.66389f43.js";import"./ConfirmationModal.2e591634.js";import"./PrintButton.4cc48b69.js";import"./ErrorMessage.7df8a495.js";import"./XCircleIcon.0d2fb5b2.js";const T={components:{AppLayout:h,Card:L,MainArea:g,SearchInventory:x,InventorySizeUpdate:A,InventoryQuantityUpdate:N,InventoryLocationUpdate:I,ReprintTag:z},props:{inventory:Object,sizes:Array},data(){return{autoLocateNotice:{wasAutoLocated:!1,message:null}}},unmounted(){localStorage.lastInventoryId=this.inventory.id},methods:{updateLocatedNotice(s){this.autoLocateNotice=s}}},V={class:"mt-6 grid divide-y divide-gray-100"},b={class:"py-4"},R={class:"text-xl"},U={class:"text-lg"},q={class:"text-green-600"},O={class:"py-4"};function j(s,D,t,E,r,d){const m=e("SearchInventory"),p=e("inventory-quantity-update"),_=e("inventory-size-update"),l=e("inventory-location-update"),y=e("ReprintTag"),u=e("Card"),v=e("MainArea"),f=e("AppLayout");return c(),S(f,null,{default:i(()=>[o(v,{dontShowOnMobile:!1},{default:i(()=>[o(u,{class:"max-w-screen-sm"},{default:i(()=>[o(m),n("div",V,[n("div",b,[n("h1",R,a(t.inventory.product.name),1),n("p",U,[w(a(t.inventory.type=="group"?"Group ":"Plant ")+"#: ",1),n("span",q,a(t.inventory.id),1)]),r.autoLocateNotice.message?(c(),M("p",{key:0,class:k([r.autoLocateNotice.wasAutoLocated?"text-green-600":"text-red-500","mt-2"])},a(r.autoLocateNotice.message),3)):B("",!0)]),o(p,{inventory:t.inventory},null,8,["inventory"]),o(_,{sizes:t.sizes,inventory:t.inventory},null,8,["sizes","inventory"]),o(l,{inventory:t.inventory,onAutolocated:d.updateLocatedNotice},null,8,["inventory","onAutolocated"]),n("p",O," Last Inventoried: "+a(t.inventory.last_inventory_date),1),o(y,{inventory:t.inventory},null,8,["inventory"])])]),_:1})]),_:1})]),_:1})}var st=C(T,[["render",j]]);export{st as default};