import{_ as C,a7 as B,r as x,o as u,J as v,a as _,b as a,w as e,P as m,M as h,j as f,W as b,c as g,a0 as y,a6 as J,a1 as D,d as n,an as $}from"./app.9dc34ef4.js";import{J as S}from"./ConfirmationModal.47b3bac6.js";import"./Modal.c8b704a0.js";const V={components:{JetSectionTitle:B}},M={class:"md:grid md:gap-6"},N={class:"mt-5 md:mt-0 md:col-span-2"},j={class:"px-4 py-5 bg-white sm:p-6 shadow"};function A(s,l,t,c,i,w){const p=x("jet-section-title");return u(),v("div",M,[_("div",N,[_("div",j,[a(p,{class:"col-span-6"},{title:e(()=>[m(s.$slots,"title")]),description:e(()=>[m(s.$slots,"description")]),_:3}),m(s.$slots,"default")])])])}var L=C(V,[["render",A]]);const T={key:0,class:"animate-spin -ml-1 mr-3 h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},z=_("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"},null,-1),O=_("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"},null,-1),P=[z,O],k={__name:"Loader",props:{loading:Boolean},setup(s){return(l,t)=>s.loading?(u(),v("svg",T,P)):h("",!0)}},Q=n(" Connect your accounting system "),q=n(" Sync your orders and quotes with your accounting platform of choice, including QuickBooks Online or QuickBooks Desktop. "),E=n(" Connect now "),F=n(" Disconnect now "),H=n(" Disconnect "),I=n(" Are you sure you want to disconnect accounting? "),R=n(" Cancel "),U=n(" Disconnect "),X={__name:"ConnectAccounting",props:["team"],setup(s){const l=s,t=f(!1),c=f(!1),i=f(!!l.team.codat_company_id);function w(){t.value=!0;const{team:r}=l;$.post(route("teams.connect",{team:r})).then(({data:{redirectUrl:o}})=>{let d=new URL(o);d.searchParams.append("teamId",r.id),window.location.href=d,i.value=!0}).finally(()=>{t.value=!1})}function p(){t.value=!0,c.value=!1;const{team:r}=l;$.delete(route("teams.disconnect",{team:r})).then(()=>{i.value=!1}).finally(()=>{t.value=!1})}return(r,o)=>(u(),v(b,null,[a(L,null,{title:e(()=>[Q]),description:e(()=>[q]),default:e(()=>[i.value?h("",!0):(u(),g(y,{key:0,type:"button",disabled:t.value,onClick:w},{default:e(()=>[a(k,{loading:t.value},null,8,["loading"]),E]),_:1},8,["disabled"])),i.value?(u(),g(y,{key:1,type:"button",disabled:t.value,onClick:o[0]||(o[0]=d=>c.value=!0)},{default:e(()=>[a(k,{loading:t.value},null,8,["loading"]),F]),_:1},8,["disabled"])):h("",!0)]),_:1}),a(S,{show:c.value,onClose:o[2]||(o[2]=d=>c.value=!1)},{title:e(()=>[H]),content:e(()=>[I]),footer:e(()=>[a(J,{onClick:o[1]||(o[1]=d=>c.value=!1)},{default:e(()=>[R]),_:1}),a(D,{class:"ml-2",onClick:p},{default:e(()=>[U]),_:1})]),_:1},8,["show"])],64))}};export{X as default};
