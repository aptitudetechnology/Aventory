import{ac as d,_ as i,a2 as u,r as s,o as p,J as _,a,b as l,ae as f,af as h,ag as m}from"./app.9dc34ef4.js";const{createVNode:v,openBlock:S,createBlock:y}=d;var g=function(o,e){return S(),y("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[v("path",{"fill-rule":"evenodd",d:"M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z","clip-rule":"evenodd"})])};const I={components:{JetInput:u,SearchIcon:g},props:{modelValue:String,placeholder:{type:String,default:"Search"},autofocus:{type:Boolean,default:!1},autocomplete:{type:String,default:"off"},type:{type:String,default:"search"},pattern:{type:String},inputmode:{type:String},disabled:{type:Boolean,default:!1},title:{type:String,default:"Search"}},emits:["update:modelValue"],methods:{focus(){this.$refs.input.focus()}},updated(){this.autofocus&&this.focus()},mounted(){this.autofocus&&this.focus()}},w=t=>(h("data-v-287c75ee"),t=t(),m(),t),x={class:"flex space-x-4"},B={class:"flex-1 min-w-0"},V=w(()=>a("label",{for:"search",class:"sr-only"},"Search",-1)),b={class:"relative rounded-md shadow-sm"},k={class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"};function N(t,o,e,j,z,C){const c=s("SearchIcon"),n=s("jet-input");return p(),_("div",x,[a("div",B,[V,a("div",b,[a("div",k,[l(c,{class:"h-5 w-5 text-gray-400","aria-hidden":"true"})]),l(n,f({value:e.modelValue,onInput:o[0]||(o[0]=r=>t.$emit("update:modelValue",r.target.value)),ref:"input",type:e.type},t.$attrs,{name:"search",id:"search",inputmode:e.inputmode,pattern:e.pattern,title:e.title,autocomplete:e.autocomplete,disabled:e.disabled,class:"w-full pl-10",placeholder:e.placeholder}),null,16,["value","type","inputmode","pattern","title","autocomplete","disabled","placeholder"])])])])}var M=i(I,[["render",N],["__scopeId","data-v-287c75ee"]]);export{M as S};
