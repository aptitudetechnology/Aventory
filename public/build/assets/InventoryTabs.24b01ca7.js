import{T as c,a as i}from"./TabLink.6500eaa0.js";import{_ as l,r as o,o as p,c as _,w as t,b as r,d as a}from"./app.123e766a.js";const u={components:{TabContainer:c,TabLink:i}},d=a("Inventory"),f=a("Clear Assigned Locations");function b(e,m,h,v,y,k){const n=o("tab-link"),s=o("tab-container");return p(),_(s,{class:"tabs-boxed px-2"},{default:t(()=>[r(n,{href:e.route("inventory.index"),current:e.route().current("inventory.index"),type:"pill"},{default:t(()=>[d]),_:1},8,["href","current"]),r(n,{href:e.route("inventory.clear-locations"),current:e.route().current("inventory.clear-locations"),type:"pill"},{default:t(()=>[f]),_:1},8,["href","current"])]),_:1})}var C=l(u,[["render",b]]);export{C as I};
