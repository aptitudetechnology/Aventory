import{o as r,c as b,b as l,_ as w,r as c,J as i,P as y,a as o,w as a,N as _,M as p,W as g,X as M,O as A,Q as S,aq as B,L as q,d as h}from"./app.123e766a.js";import{J as I}from"./DialogModal.11efde9a.js";import{E as O}from"./ErrorMessage.9555be26.js";import"./Modal.c06c0ace.js";import"./XCircleIcon.401ddebd.js";function j(n,t){return r(),b("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","aria-hidden":"true"},[l("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"})])}const L={components:{SparklesIcon:j}},N={class:"btn btn-sm btn-outline pl-2 flex items-center"};function V(n,t,u,C,d,s){const m=c("SparklesIcon");return r(),i("button",N,[l(m,{class:"w-6 h-6 stroke-current mr-2"}),y(n.$slots,"default")])}var E=w(L,[["render",V]]);const z={components:{ActionButton:E,DialogModal:I,ErrorMessage:O},props:{order:{type:Object,required:!0}},data(){return{customConvert:!1,items:[],errorMessage:"",availableItems:this.order.items}},computed:{convertText(){return this.order.is_quote?"Convert to Order":"Convert to Quote"}},methods:{convert(){if(this.customConvert&&!this.items.length){this.errorMessage="Please select items to convert.";return}this.$inertia.post(route("sales.convert",this.order.id),{items:this.items})},showCustomConvert(){this.customConvert=!0},addOrRemoveItem(n){this.isAdded(n)?this.items=this.items.filter(t=>t.id!==n.id):this.items.push(n)},isAdded(n){return this.items.find(t=>t.id===n.id)}}},D={class:"dropdown dropdown-hover dropdown-end"},Q=h("Actions"),T={tabindex:"0",class:"shadow menu dropdown-content bg-base-100 rounded-lg text-right w-52"},J={key:0},P={key:1},R=h(" Select order items to convert to order. "),U=["onSubmit"],F={class:"input-group input-group-sm"},W=o("span",{class:"label-text"},"Qty",-1),X=["disabled","onUpdate:modelValue"],G={key:0},H={key:1},K=h("Create Order");function Y(n,t,u,C,d,s){const m=c("ActionButton"),k=c("ErrorMessage"),v=c("jet-button"),x=c("dialog-modal");return r(),i(g,null,[o("div",D,[l(m,{class:"bg-white"},{default:a(()=>[Q]),_:1}),o("ul",T,[!u.order.is_quote||u.order.status=="Pending"?(r(),i("li",J,[o("a",{onClick:t[0]||(t[0]=(...e)=>s.convert&&s.convert(...e)),class:"justify-end px-4 capitalize"},_(s.convertText),1)])):p("",!0),u.order.is_quote?(r(),i("li",P,[o("a",{onClick:t[1]||(t[1]=(...e)=>s.showCustomConvert&&s.showCustomConvert(...e)),class:"justify-end px-4"},"New Order from Quote")])):p("",!0)])]),l(x,{show:d.customConvert,onClose:t[2]||(t[2]=e=>d.customConvert=!1)},{title:a(()=>[R]),content:a(()=>[o("div",null,[d.errorMessage?(r(),b(k,{key:0,title:d.errorMessage,message:d.errorMessage},null,8,["title","message"])):p("",!0),(r(!0),i(g,null,M(d.availableItems,e=>(r(),i("div",{key:e.id,class:"flex items-center py-2"},[o("span",null,_(e.size_name)+" "+_(e.product_name),1),o("form",{onSubmit:A(f=>s.addOrRemoveItem(e),["prevent"]),class:"ml-auto flex items-center"},[o("label",F,[W,S(o("input",{disabled:s.isAdded(e),type:"number",min:"0","onUpdate:modelValue":f=>e.quantity=f,class:"input input-bordered input-sm w-20"},null,8,X),[[B,e.quantity]])]),l(v,{type:"submit",class:q(["ml-2 btn-sm",s.isAdded(e)?"btn-error":""])},{default:a(()=>[s.isAdded(e)?(r(),i("span",G,"Remove")):(r(),i("span",H,"Add"))]),_:2},1032,["class"])],40,U)]))),128))])]),footer:a(()=>[l(v,{onClick:s.convert},{default:a(()=>[K]),_:1},8,["onClick"])]),_:1},8,["show"])],64)}var oe=w(z,[["render",Y]]);export{oe as default};
