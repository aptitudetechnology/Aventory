import{_ as y,a0 as S,a2 as I,a4 as J,a5 as V,a6 as C,r as n,o as d,c as _,w as s,J as N,a as l,b as o,Q as v,U as P,as as B,O as b,M as g,L as U,d as a}from"./app.9dc34ef4.js";import{J as F}from"./FormSection.d0f32ab4.js";import{J as x}from"./ActionMessage.59b94243.js";const z={components:{JetActionMessage:x,JetButton:S,JetFormSection:F,JetInput:I,JetInputError:J,JetLabel:V,JetSecondaryButton:C},props:["user"],data(){return{form:this.$inertia.form({_method:"PUT",name:this.user.name,email:this.user.email,photo:null}),photoPreview:null}},methods:{updateProfileInformation(){this.$refs.photo&&(this.form.photo=this.$refs.photo.files[0]),this.form.post(route("user-profile-information.update"),{errorBag:"updateProfileInformation",preserveScroll:!0,onSuccess:()=>this.clearPhotoFileInput()})},selectNewPhoto(){this.$refs.photo.click()},updatePhotoPreview(){const r=this.$refs.photo.files[0];if(!r)return;const t=new FileReader;t.onload=i=>{this.photoPreview=i.target.result},t.readAsDataURL(r)},deletePhoto(){this.$inertia.delete(route("current-user-photo.destroy"),{preserveScroll:!0,onSuccess:()=>{this.photoPreview=null,this.clearPhotoFileInput()}})},clearPhotoFileInput(){var r;(r=this.$refs.photo)!=null&&r.value&&(this.$refs.photo.value=null)}}},A=a(" Profile Information "),E=a(" Update your account's profile information and email address. "),L={key:0,class:"col-span-6 sm:col-span-4"},M={class:"mt-2"},R=["src","alt"],D={class:"mt-2"},T=a(" Select A New Photo "),O=a(" Remove Photo "),Q={class:"col-span-6 sm:col-span-4"},q={class:"col-span-6 sm:col-span-4"},G=a(" Saved. "),H=a(" Save ");function K(r,t,i,W,e,c){const u=n("jet-label"),h=n("jet-secondary-button"),p=n("jet-input-error"),f=n("jet-input"),w=n("jet-action-message"),k=n("jet-button"),j=n("jet-form-section");return d(),_(j,{onSubmitted:c.updateProfileInformation},{title:s(()=>[A]),description:s(()=>[E]),form:s(()=>[r.$page.props.jetstream.managesProfilePhotos?(d(),N("div",L,[l("input",{type:"file",class:"hidden",ref:"photo",onChange:t[0]||(t[0]=(...m)=>c.updatePhotoPreview&&c.updatePhotoPreview(...m))},null,544),o(u,{for:"photo",value:"Photo"}),v(l("div",M,[l("img",{src:i.user.profile_photo_url,alt:i.user.name,class:"rounded-full h-20 w-20 object-cover"},null,8,R)],512),[[P,!e.photoPreview]]),v(l("div",D,[l("span",{class:"block rounded-full w-20 h-20",style:B("background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('"+e.photoPreview+"');")},null,4)],512),[[P,e.photoPreview]]),o(h,{class:"mt-2 mr-2",type:"button",onClick:b(c.selectNewPhoto,["prevent"])},{default:s(()=>[T]),_:1},8,["onClick"]),i.user.profile_photo_path?(d(),_(h,{key:0,type:"button",class:"mt-2",onClick:b(c.deletePhoto,["prevent"])},{default:s(()=>[O]),_:1},8,["onClick"])):g("",!0),o(p,{message:e.form.errors.photo,class:"mt-2"},null,8,["message"])])):g("",!0),l("div",Q,[o(u,{for:"name",value:"Name"}),o(f,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:e.form.name,"onUpdate:modelValue":t[1]||(t[1]=m=>e.form.name=m),autocomplete:"name"},null,8,["modelValue"]),o(p,{message:e.form.errors.name,class:"mt-2"},null,8,["message"])]),l("div",q,[o(u,{for:"email",value:"Email"}),o(f,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e.form.email,"onUpdate:modelValue":t[2]||(t[2]=m=>e.form.email=m)},null,8,["modelValue"]),o(p,{message:e.form.errors.email,class:"mt-2"},null,8,["message"])])]),actions:s(()=>[o(w,{on:e.form.recentlySuccessful,class:"mr-3"},{default:s(()=>[G]),_:1},8,["on"]),o(k,{class:U({"opacity-25":e.form.processing}),disabled:e.form.processing},{default:s(()=>[H]),_:1},8,["class","disabled"])]),_:1},8,["onSubmitted"])}var $=y(z,[["render",K]]);export{$ as default};
