import{J as v}from"./AuthenticationCard.cf7628a4.js";import{J as y}from"./AuthenticationCardLogo.2ca1b1b5.js";import{_ as J,a0 as V,a2 as C,a3 as L,a5 as B,r as e,o as m,c as _,w as n,b as t,J as N,N as q,M as p,a,L as E,O as P,d as f}from"./app.fa9cc1ae.js";import{J as R}from"./ValidationErrors.ad500003.js";const S={components:{JetAuthenticationCard:v,JetAuthenticationCardLogo:y,JetButton:V,JetInput:C,JetCheckbox:L,JetLabel:B,JetValidationErrors:R},props:{canResetPassword:Boolean,status:String},data(){return{form:this.$inertia.form({email:"",password:"",remember:!1})}},methods:{submit(){this.form.transform(l=>({...l,remember:this.form.remember?"on":""})).post(this.route("login"),{onFinish:()=>this.form.reset("password")})}}},U=a("span",{class:"text-2xl font-bold"},"Login to your account",-1),A={key:0,class:"mb-4 text-sm text-green-600"},F={class:"mt-4"},M={class:"block mt-4"},z={class:"flex items-center"},D=a("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),I={class:"flex items-center justify-end mt-4"},O=f(" Forgot your password? "),T=f(" Log in ");function G(l,o,i,H,s,c){const b=e("jet-authentication-card-logo"),h=e("jet-authentication-card-title"),x=e("jet-validation-errors"),d=e("jet-label"),u=e("jet-input"),w=e("jet-checkbox"),g=e("Link"),j=e("jet-button"),k=e("jet-authentication-card");return m(),_(k,null,{logo:n(()=>[t(b)]),title:n(()=>[t(h,null,{default:n(()=>[U]),_:1})]),default:n(()=>[t(x,{class:"mb-4"}),i.status?(m(),N("div",A,q(i.status),1)):p("",!0),a("form",{onSubmit:o[3]||(o[3]=P((...r)=>c.submit&&c.submit(...r),["prevent"]))},[a("div",null,[t(d,{for:"email",value:"Email"}),t(u,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s.form.email,"onUpdate:modelValue":o[0]||(o[0]=r=>s.form.email=r),required:"",autofocus:""},null,8,["modelValue"])]),a("div",F,[t(d,{for:"password",value:"Password"}),t(u,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s.form.password,"onUpdate:modelValue":o[1]||(o[1]=r=>s.form.password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"])]),a("div",M,[a("label",z,[t(w,{name:"remember",checked:s.form.remember,"onUpdate:checked":o[2]||(o[2]=r=>s.form.remember=r)},null,8,["checked"]),D])]),a("div",I,[i.canResetPassword?(m(),_(g,{key:0,href:l.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:n(()=>[O]),_:1},8,["href"])):p("",!0),t(j,{class:E(["ml-4",{"opacity-25":s.form.processing}]),disabled:s.form.processing},{default:n(()=>[T]),_:1},8,["class","disabled"])])],32)]),_:1})}var Y=J(S,[["render",G]]);export{Y as default};