import{f as h,j as b,p as v,h as y,m,i as w,C as S,v as k,K as d,A as C}from"./app.9dc34ef4.js";import{u as K,D}from"./description.esm.f365edce.js";import{u as V,L as R}from"./label.esm.2a39737d.js";var f=Symbol("GroupContext"),L=h({name:"SwitchGroup",props:{as:{type:[Object,String],default:"template"}},setup:function(t,a){var i=a.slots,n=a.attrs,e=b(null),o=V({name:"SwitchLabel",props:{onClick:function(){!e.value||(e.value.click(),e.value.focus({preventScroll:!0}))}}}),l=K({name:"SwitchDescription"}),u={switchRef:e,labelledby:o,describedby:l};return v(f,u),function(){return y({props:t,slot:{},slots:i,attrs:n,name:"SwitchGroup"})}}}),g=h({name:"Switch",emits:{"update:modelValue":function(t){return!0}},props:{as:{type:[Object,String],default:"button"},modelValue:{type:Boolean,default:!1}},render:function(){var t={checked:this.$props.modelValue},a={id:this.id,ref:"el",role:"switch",type:this.type,tabIndex:0,"aria-checked":this.$props.modelValue,"aria-labelledby":this.labelledby,"aria-describedby":this.describedby,onClick:this.handleClick,onKeyup:this.handleKeyUp,onKeypress:this.handleKeyPress};return y({props:m({},this.$props,a),slot:t,attrs:this.$attrs,slots:this.$slots,name:"Switch"})},setup:function(t,a){var i=a.emit,n=a.attrs,e=w(f,null),o="headlessui-switch-"+C();function l(){i("update:modelValue",!t.modelValue)}var u=b(null),p=e===null?u:e.switchRef;return{id:o,el:p,type:S(k(function(){return{as:t.as,type:n.type}}),p),labelledby:e==null?void 0:e.labelledby,describedby:e==null?void 0:e.describedby,handleClick:function(s){s.preventDefault(),l()},handleKeyUp:function(s){s.key!==d.Tab&&s.preventDefault(),s.key===d.Space&&l()},handleKeyPress:function(s){s.preventDefault()}}}}),j=R,P=D;export{g as S,P as a,L as b,j as c};
