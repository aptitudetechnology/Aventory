import a from"./VendorsLayout.cd58e072.js";import d from"./UpdateVendorForm.65c7400e.js";import{B as s}from"./ButtonLink.6e91a4bc.js";import p from"./DeleteVendorForm.9006ea20.js";import l from"./ContactAside.dc9af1c3.js";import{_,r as t,o as v,c as f,w as u,a as r,b as e}from"./app.fa9cc1ae.js";import"./AppLayout.3304023d.js";import"./use-tree-walker.esm.46f3148c.js";import"./description.esm.1831666a.js";import"./BackLink.312081a6.js";import"./ChevronLeftIcon.cd6cd1a4.js";import"./VendorsAside.5177c67e.js";import"./TabLink.82ecb71e.js";import"./SearchInput.afb6d862.js";import"./AsideLink.fe2f99e0.js";import"./EmptyState.12be0778.js";import"./MainArea.def08b37.js";import"./FormSection.c4fa96d0.js";import"./ActionMessage.5ee845ce.js";import"./switch.esm.a7d5a89c.js";import"./label.esm.1dccfab2.js";import"./ActionSection.0b0eae6e.js";import"./ConfirmationModal.2e591634.js";import"./Modal.66389f43.js";import"./CreateContactComponent.8b820440.js";import"./DialogModal.ea7b6519.js";import"./UpdateContactComponent.ea5163d5.js";import"./DeleteContactComponent.8b4b540b.js";const g={components:{VendorsLayout:a,UpdateVendorForm:d,ButtonLink:s,DeleteVendorForm:p,ContactAside:l},props:{vendor:Object}},b={class:"lg:grid lg:grid-cols-8 gap-4"},h={class:"lg:col-span-5 mb-6"},B={class:"lg:col-span-3"};function V(x,y,o,k,w,C){const n=t("update-vendor-form"),c=t("contact-aside"),i=t("delete-vendor-form"),m=t("vendors-layout");return v(),f(m,null,{default:u(()=>[r("div",null,[r("div",b,[r("div",h,[e(n,{vendor:o.vendor},null,8,["vendor"])]),r("div",B,[e(c,{"contactable-type":"vendors","contactable-id":o.vendor.id,contacts:o.vendor.contacts},null,8,["contactable-id","contacts"])])]),e(i,{vendor:o.vendor},null,8,["vendor"])])]),_:1})}var to=_(g,[["render",V]]);export{to as default};