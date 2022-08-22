import{J as h}from"./AuthenticationCard.cf7628a4.js";import{J as p}from"./AuthenticationCardLogo.2ca1b1b5.js";import{_ as g,a0 as y,r as t,o as r,c as b,w as e,b as s,J as v,M as k,a as i,L as x,O as j,d as c}from"./app.fa9cc1ae.js";const w={components:{JetAuthenticationCard:h,JetAuthenticationCardLogo:p,JetButton:y},props:{status:String},data(){return{form:this.$inertia.form()}},methods:{submit(){this.form.post(this.route("verification.send"))}},computed:{verificationLinkSent(){return this.status==="verification-link-sent"}}},L=i("div",{class:"mb-4 text-sm text-gray-600"}," Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1),B={key:0,class:"mb-4 text-sm text-green-600"},C={class:"mt-4 flex items-center justify-between"},J=c(" Resend Verification Email "),V=c("Log Out");function N(d,n,S,A,a,o){const u=t("jet-authentication-card-logo"),m=t("jet-button"),l=t("Link"),f=t("jet-authentication-card");return r(),b(f,null,{logo:e(()=>[s(u)]),default:e(()=>[L,o.verificationLinkSent?(r(),v("div",B," A new verification link has been sent to the email address you provided during registration. ")):k("",!0),i("form",{onSubmit:n[0]||(n[0]=j((..._)=>o.submit&&o.submit(..._),["prevent"]))},[i("div",C,[s(m,{class:x({"opacity-25":a.form.processing}),disabled:a.form.processing},{default:e(()=>[J]),_:1},8,["class","disabled"]),s(l,{href:d.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:e(()=>[V]),_:1},8,["href"])])],32)]),_:1})}var T=g(w,[["render",N]]);export{T as default};