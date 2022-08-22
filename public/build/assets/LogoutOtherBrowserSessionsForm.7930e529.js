import{J as k}from"./ActionMessage.df590980.js";import{J as x}from"./ActionSection.c21f2eec.js";import{_ as b,a0 as j,a2 as B,a4 as C,a6 as S,r as i,o as r,c as L,w as e,J as a,W as M,X as J,a as o,N as d,d as s,M as O,b as c,a8 as V,L as N}from"./app.123e766a.js";import{J as I}from"./DialogModal.11efde9a.js";import"./Modal.c06c0ace.js";const z={props:["sessions"],components:{JetActionMessage:k,JetActionSection:x,JetButton:j,JetDialogModal:I,JetInput:B,JetInputError:C,JetSecondaryButton:S},data(){return{confirmingLogout:!1,form:this.$inertia.form({password:""})}},methods:{confirmLogout(){this.confirmingLogout=!0,setTimeout(()=>this.$refs.password.focus(),250)},logoutOtherBrowserSessions(){this.form.delete(route("other-browser-sessions.destroy"),{preserveScroll:!0,onSuccess:()=>this.closeModal(),onError:()=>this.$refs.password.focus(),onFinish:()=>this.form.reset()})},closeModal(){this.confirmingLogout=!1,this.form.reset()}}},D=s(" Browser Sessions "),E=s(" Manage and log out your active sessions on other browsers and devices. "),F=o("div",{class:"max-w-xl text-sm text-gray-600"}," If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password. ",-1),K={key:0,class:"mt-5 space-y-6"},T={key:0,fill:"none","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",viewBox:"0 0 24 24",stroke:"currentColor",class:"w-8 h-8 text-gray-500"},A=o("path",{d:"M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"},null,-1),H=[A],P={key:1,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round",class:"w-8 h-8 text-gray-500"},U=o("path",{d:"M0 0h24v24H0z",stroke:"none"},null,-1),W=o("rect",{x:"7",y:"4",width:"10",height:"16",rx:"1"},null,-1),X=o("path",{d:"M11 5h2M12 17v.01"},null,-1),q=[U,W,X],G={class:"ml-3"},Q={class:"text-sm text-gray-600"},R={class:"text-xs text-gray-500"},Y={key:0,class:"text-green-500 font-semibold"},Z={key:1},$={class:"flex items-center mt-5"},oo=s(" Log Out Other Browser Sessions "),eo=s(" Done. "),so=s(" Log Out Other Browser Sessions "),to=s(" Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices. "),ro={class:"mt-4"},no=s(" Cancel "),io=s(" Log Out Other Browser Sessions ");function ao(co,_,u,lo,n,l){const m=i("jet-button"),h=i("jet-action-message"),f=i("jet-input"),p=i("jet-input-error"),g=i("jet-secondary-button"),w=i("jet-dialog-modal"),y=i("jet-action-section");return r(),L(y,null,{title:e(()=>[D]),description:e(()=>[E]),content:e(()=>[F,u.sessions.length>0?(r(),a("div",K,[(r(!0),a(M,null,J(u.sessions,(t,v)=>(r(),a("div",{class:"flex items-center",key:v},[o("div",null,[t.agent.is_desktop?(r(),a("svg",T,H)):(r(),a("svg",P,q))]),o("div",G,[o("div",Q,d(t.agent.platform)+" - "+d(t.agent.browser),1),o("div",null,[o("div",R,[s(d(t.ip_address)+", ",1),t.is_current_device?(r(),a("span",Y,"This device")):(r(),a("span",Z,"Last active "+d(t.last_active),1))])])])]))),128))])):O("",!0),o("div",$,[c(m,{onClick:l.confirmLogout},{default:e(()=>[oo]),_:1},8,["onClick"]),c(h,{on:n.form.recentlySuccessful,class:"ml-3"},{default:e(()=>[eo]),_:1},8,["on"])]),c(w,{show:n.confirmingLogout,onClose:l.closeModal},{title:e(()=>[so]),content:e(()=>[to,o("div",ro,[c(f,{type:"password",class:"mt-1 block w-3/4",placeholder:"Password",ref:"password",modelValue:n.form.password,"onUpdate:modelValue":_[0]||(_[0]=t=>n.form.password=t),onKeyup:V(l.logoutOtherBrowserSessions,["enter"])},null,8,["modelValue","onKeyup"]),c(p,{message:n.form.errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[c(g,{onClick:l.closeModal},{default:e(()=>[no]),_:1},8,["onClick"]),c(m,{class:N(["ml-2",{"opacity-25":n.form.processing}]),onClick:l.logoutOtherBrowserSessions,disabled:n.form.processing},{default:e(()=>[io]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show","onClose"])]),_:1})}var po=b(z,[["render",ao]]);export{po as default};
