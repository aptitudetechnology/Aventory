import{r as n}from"./PaperClipIcon.08ab8c0c.js";import d from"./CustomersLayout.f0b064e1.js";import{_,Y as l,r as o,o as u,c as p,w as r,b as m,d as x,N as e,a as t}from"./app.fbac1591.js";import h from"./RestoreCustomerForm.ea84d6b8.js";import"./AppLayout.882645d6.js";import"./use-tree-walker.esm.96420529.js";import"./description.esm.86a5930e.js";import"./BackLink.c23c1c07.js";import"./ChevronLeftIcon.65bc558d.js";import"./CustomersAside.c6025233.js";import"./ButtonLink.b5238133.js";import"./TabLink.e3fb786d.js";import"./SearchInput.2b0acd82.js";import"./AsideLink.a174d96a.js";import"./EmptyState.af78f495.js";import"./MainArea.39d829c5.js";import"./ActionSection.cf8bfbe1.js";import"./ConfirmationModal.5724143c.js";import"./Modal.bd4b42b5.js";const f={components:{PaperClipIcon:n,CustomersLayout:d,DetailsSection:l,RestoreCustomerForm:h},props:{customer:Object}},y={class:"sm:col-span-2"},g=t("dt",{class:"text-sm text-gray-500"},"Customer name",-1),C={class:"mt-1 text-sm text-gray-900"},v={class:"sm:col-span-1"},N=t("dt",{class:"text-sm text-gray-500"},"Customer Address",-1),w={class:"mt-1 text-sm text-gray-900"},B={class:"mt-1 text-sm text-gray-900"},S={class:"sm:col-span-2"},V=t("dt",{class:"text-sm text-gray-500"},"Notes",-1),b={class:"mt-1 text-sm text-gray-900"};function k(A,D,s,j,z,F){const c=o("details-section"),a=o("restore-customer-form"),i=o("customers-layout");return u(),p(i,null,{default:r(()=>[m(c,null,{header:r(()=>[x(e(s.customer.name),1)]),default:r(()=>[t("div",y,[g,t("dd",C,e(s.customer.name),1)]),t("div",v,[N,t("dd",w,e(s.customer.address),1),t("dd",B,e(s.customer.city)+" "+e(s.customer.state)+" "+e(s.customer.zip),1)]),t("div",S,[V,t("dd",b,e(s.customer.notes),1)])]),_:1}),m(a,{customer:s.customer,class:"mt-6"},null,8,["customer"])]),_:1})}var $=_(f,[["render",k]]);export{$ as default};