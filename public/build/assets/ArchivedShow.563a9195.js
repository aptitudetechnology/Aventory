import{r as n}from"./PaperClipIcon.8b132984.js";import d from"./CustomersLayout.e911eb77.js";import{_,Y as l,r as o,o as u,c as p,w as r,b as m,d as x,N as e,a as t}from"./app.fa9cc1ae.js";import h from"./RestoreCustomerForm.73472cc9.js";import"./AppLayout.3304023d.js";import"./use-tree-walker.esm.46f3148c.js";import"./description.esm.1831666a.js";import"./BackLink.312081a6.js";import"./ChevronLeftIcon.cd6cd1a4.js";import"./CustomersAside.f13e7acf.js";import"./ButtonLink.6e91a4bc.js";import"./TabLink.82ecb71e.js";import"./SearchInput.afb6d862.js";import"./AsideLink.fe2f99e0.js";import"./EmptyState.12be0778.js";import"./MainArea.def08b37.js";import"./ActionSection.0b0eae6e.js";import"./ConfirmationModal.2e591634.js";import"./Modal.66389f43.js";const f={components:{PaperClipIcon:n,CustomersLayout:d,DetailsSection:l,RestoreCustomerForm:h},props:{customer:Object}},y={class:"sm:col-span-2"},g=t("dt",{class:"text-sm text-gray-500"},"Customer name",-1),C={class:"mt-1 text-sm text-gray-900"},v={class:"sm:col-span-1"},N=t("dt",{class:"text-sm text-gray-500"},"Customer Address",-1),w={class:"mt-1 text-sm text-gray-900"},B={class:"mt-1 text-sm text-gray-900"},S={class:"sm:col-span-2"},V=t("dt",{class:"text-sm text-gray-500"},"Notes",-1),b={class:"mt-1 text-sm text-gray-900"};function k(A,D,s,j,z,F){const c=o("details-section"),a=o("restore-customer-form"),i=o("customers-layout");return u(),p(i,null,{default:r(()=>[m(c,null,{header:r(()=>[x(e(s.customer.name),1)]),default:r(()=>[t("div",y,[g,t("dd",C,e(s.customer.name),1)]),t("div",v,[N,t("dd",w,e(s.customer.address),1),t("dd",B,e(s.customer.city)+" "+e(s.customer.state)+" "+e(s.customer.zip),1)]),t("div",S,[V,t("dd",b,e(s.customer.notes),1)])]),_:1}),m(a,{customer:s.customer,class:"mt-6"},null,8,["customer"])]),_:1})}var $=_(f,[["render",k]]);export{$ as default};