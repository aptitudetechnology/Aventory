import{J as P}from"./ActionSection.8b02576e.js";import{_ as v,a0 as x,a2 as F,a4 as T,a6 as k,r as c,o as s,J as i,a,P as J,b as r,w as o,d,N as p,a8 as S,L as C,a1 as R,c as b,M as _,W as A,X as M}from"./app.9dc34ef4.js";import{J as B}from"./DialogModal.13bcfa5f.js";import"./Modal.c8b704a0.js";const E={emits:["confirmed"],props:{title:{default:"Confirm Password"},content:{default:"For your security, please confirm your password to continue."},button:{default:"Confirm"}},components:{JetButton:x,JetDialogModal:B,JetInput:F,JetInputError:T,JetSecondaryButton:k},data(){return{confirmingPassword:!1,form:{password:"",error:""}}},methods:{startConfirmingPassword(){axios.get(route("password.confirmation")).then(n=>{n.data.confirmed?this.$emit("confirmed"):(this.confirmingPassword=!0,setTimeout(()=>this.$refs.password.focus(),250))})},confirmPassword(){this.form.processing=!0,axios.post(route("password.confirm"),{password:this.form.password}).then(()=>{this.form.processing=!1,this.closeModal(),this.$nextTick(()=>this.$emit("confirmed"))}).catch(n=>{this.form.processing=!1,this.form.error=n.response.data.errors.password[0],this.$refs.password.focus()})},closeModal(){this.confirmingPassword=!1,this.form.password="",this.form.error=""}}},V={class:"mt-4"},q=d(" Cancel ");function N(n,m,f,j,e,t){const w=c("jet-input"),l=c("jet-input-error"),h=c("jet-secondary-button"),g=c("jet-button"),y=c("jet-dialog-modal");return s(),i("span",null,[a("span",{onClick:m[0]||(m[0]=(...u)=>t.startConfirmingPassword&&t.startConfirmingPassword(...u))},[J(n.$slots,"default")]),r(y,{show:e.confirmingPassword,onClose:t.closeModal},{title:o(()=>[d(p(f.title),1)]),content:o(()=>[d(p(f.content)+" ",1),a("div",V,[r(w,{type:"password",class:"mt-1 block w-3/4",placeholder:"Password",ref:"password",modelValue:e.form.password,"onUpdate:modelValue":m[1]||(m[1]=u=>e.form.password=u),onKeyup:S(t.confirmPassword,["enter"])},null,8,["modelValue","onKeyup"]),r(l,{message:e.form.error,class:"mt-2"},null,8,["message"])])]),footer:o(()=>[r(h,{onClick:t.closeModal},{default:o(()=>[q]),_:1},8,["onClick"]),r(g,{class:C(["ml-2",{"opacity-25":e.form.processing}]),onClick:t.confirmPassword,disabled:e.form.processing},{default:o(()=>[d(p(f.button),1)]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show","onClose"])])}var D=v(E,[["render",N]]);const L={components:{JetActionSection:P,JetButton:x,JetConfirmsPassword:D,JetDangerButton:R,JetSecondaryButton:k},data(){return{enabling:!1,disabling:!1,qrCode:null,recoveryCodes:[]}},methods:{enableTwoFactorAuthentication(){this.enabling=!0,this.$inertia.post("/user/two-factor-authentication",{},{preserveScroll:!0,onSuccess:()=>Promise.all([this.showQrCode(),this.showRecoveryCodes()]),onFinish:()=>this.enabling=!1})},showQrCode(){return axios.get("/user/two-factor-qr-code").then(n=>{this.qrCode=n.data.svg})},showRecoveryCodes(){return axios.get("/user/two-factor-recovery-codes").then(n=>{this.recoveryCodes=n.data})},regenerateRecoveryCodes(){axios.post("/user/two-factor-recovery-codes").then(n=>{this.showRecoveryCodes()})},disableTwoFactorAuthentication(){this.disabling=!0,this.$inertia.delete("/user/two-factor-authentication",{preserveScroll:!0,onSuccess:()=>this.disabling=!1})}},computed:{twoFactorEnabled(){return!this.enabling&&this.$page.props.user.two_factor_enabled}}},K=d(" Two Factor Authentication "),Q=d(" Add additional security to your account using two factor authentication. "),Y={key:0,class:"text-lg text-gray-900"},H={key:1,class:"text-lg text-gray-900"},I=a("div",{class:"mt-3 max-w-xl text-sm text-gray-600"},[a("p",null," When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application. ")],-1),W={key:2},z={key:0},G=a("div",{class:"mt-4 max-w-xl text-sm text-gray-600"},[a("p",{class:"font-semibold"}," Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application. ")],-1),U=["innerHTML"],X={key:1},O=a("div",{class:"mt-4 max-w-xl text-sm text-gray-600"},[a("p",{class:"font-semibold"}," Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost. ")],-1),Z={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"},$={class:"mt-5"},ee={key:0},oe=d(" Enable "),te={key:1},se=d(" Regenerate Recovery Codes "),ne=d(" Show Recovery Codes "),re=d(" Disable ");function ae(n,m,f,j,e,t){const w=c("jet-button"),l=c("jet-confirms-password"),h=c("jet-secondary-button"),g=c("jet-danger-button"),y=c("jet-action-section");return s(),b(y,null,{title:o(()=>[K]),description:o(()=>[Q]),content:o(()=>[t.twoFactorEnabled?(s(),i("h3",Y," You have enabled two factor authentication. ")):(s(),i("h3",H," You have not enabled two factor authentication. ")),I,t.twoFactorEnabled?(s(),i("div",W,[e.qrCode?(s(),i("div",z,[G,a("div",{class:"mt-4",innerHTML:e.qrCode},null,8,U)])):_("",!0),e.recoveryCodes.length>0?(s(),i("div",X,[O,a("div",Z,[(s(!0),i(A,null,M(e.recoveryCodes,u=>(s(),i("div",{key:u},p(u),1))),128))])])):_("",!0)])):_("",!0),a("div",$,[t.twoFactorEnabled?(s(),i("div",te,[r(l,{onConfirmed:t.regenerateRecoveryCodes},{default:o(()=>[e.recoveryCodes.length>0?(s(),b(h,{key:0,class:"mr-3"},{default:o(()=>[se]),_:1})):_("",!0)]),_:1},8,["onConfirmed"]),r(l,{onConfirmed:t.showRecoveryCodes},{default:o(()=>[e.recoveryCodes.length===0?(s(),b(h,{key:0,class:"mr-3"},{default:o(()=>[ne]),_:1})):_("",!0)]),_:1},8,["onConfirmed"]),r(l,{onConfirmed:t.disableTwoFactorAuthentication},{default:o(()=>[r(g,{class:C({"opacity-25":e.disabling}),disabled:e.disabling},{default:o(()=>[re]),_:1},8,["class","disabled"])]),_:1},8,["onConfirmed"])])):(s(),i("div",ee,[r(l,{onConfirmed:t.enableTwoFactorAuthentication},{default:o(()=>[r(w,{type:"button",class:C({"opacity-25":e.enabling}),disabled:e.enabling},{default:o(()=>[oe]),_:1},8,["class","disabled"])]),_:1},8,["onConfirmed"])]))])]),_:1})}var ue=v(L,[["render",ae]]);export{ue as default};