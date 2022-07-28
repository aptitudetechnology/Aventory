import{_ as E,r as F,a as D,d as B,K as y,u as L}from"./dom.esm.fa0fef86.js";import{u as P,f as w,F as $,a as C}from"./use-tree-walker.esm.683d9237.js";import{u as _,D as j}from"./description.esm.62a21e39.js";import{u as x,L as K}from"./label.esm.45c99648.js";import{f as I,g as A,m as d,L as m,p as N,q as W,h as V,i as M}from"./app.c6d51eb6.js";var S=Symbol("RadioGroupContext");function T(o){var r=M(S,null);if(r===null){var t=new Error("<"+o+" /> is missing a parent <RadioGroup /> component.");throw Error.captureStackTrace&&Error.captureStackTrace(t,T),t}return r}var Q=I({name:"RadioGroup",emits:{"update:modelValue":function(r){return!0}},props:{as:{type:[Object,String],default:"div"},disabled:{type:[Boolean],default:!1},modelValue:{type:[Object,String,Number,Boolean]}},render:function(){var r=this.$props,t=E(r,["modelValue","disabled"]),u={ref:"el",id:this.id,role:"radiogroup","aria-labelledby":this.labelledby,"aria-describedby":this.describedby,onKeydown:this.handleKeyDown};return F({props:D({},t,u),slot:{},attrs:this.$attrs,slots:this.$slots,name:"RadioGroup"})},setup:function(r,t){var u=t.emit,c=A(null),i=A([]),R=x({name:"RadioGroupLabel"}),O=_({name:"RadioGroupDescription"}),p=d(function(){return r.modelValue}),b={options:i,value:p,disabled:d(function(){return r.disabled}),firstOption:d(function(){return i.value.find(function(e){return!e.propsRef.disabled})}),containsCheckedOption:d(function(){return i.value.some(function(e){return m(e.propsRef.value)===m(r.modelValue)})}),change:function(a){var l;if(r.disabled||p.value===a)return!1;var s=(l=i.value.find(function(f){return m(f.propsRef.value)===m(a)}))==null?void 0:l.propsRef;return s!=null&&s.disabled?!1:(u("update:modelValue",a),!0)},registerOption:function(a){var l,s=Array.from((l=c.value)==null?void 0:l.querySelectorAll('[id^="headlessui-radiogroup-option-"]')).reduce(function(f,h,G){var n;return Object.assign(f,(n={},n[h.id]=G,n))},{});i.value.push(a),i.value.sort(function(f,h){return s[f.id]-s[h.id]})},unregisterOption:function(a){var l=i.value.findIndex(function(s){return s.id===a});l!==-1&&i.value.splice(l,1)}};N(S,b),P({container:d(function(){return B(c)}),accept:function(a){return a.getAttribute("role")==="radio"?NodeFilter.FILTER_REJECT:a.hasAttribute("role")?NodeFilter.FILTER_SKIP:NodeFilter.FILTER_ACCEPT},walk:function(a){a.setAttribute("role","none")}});function g(e){if(!!c.value&&!!c.value.contains(e.target)){var a=i.value.filter(function(n){return n.propsRef.disabled===!1}).map(function(n){return n.element});switch(e.key){case y.ArrowLeft:case y.ArrowUp:{e.preventDefault(),e.stopPropagation();var l=w(a,$.Previous|$.WrapAround);if(l===C.Success){var s=i.value.find(function(n){return n.element===document.activeElement});s&&b.change(s.propsRef.value)}}break;case y.ArrowRight:case y.ArrowDown:{e.preventDefault(),e.stopPropagation();var f=w(a,$.Next|$.WrapAround);if(f===C.Success){var h=i.value.find(function(n){return n.element===document.activeElement});h&&b.change(h.propsRef.value)}}break;case y.Space:{e.preventDefault(),e.stopPropagation();var G=i.value.find(function(n){return n.element===document.activeElement});G&&b.change(G.propsRef.value)}break}}}var k="headlessui-radiogroup-"+L();return{id:k,labelledby:R,describedby:O,el:c,handleKeyDown:g}}}),v;(function(o){o[o.Empty=1]="Empty",o[o.Active=2]="Active"})(v||(v={}));var X=I({name:"RadioGroupOption",props:{as:{type:[Object,String],default:"div"},value:{type:[Object,String,Number,Boolean]},disabled:{type:Boolean,default:!1}},render:function(){var r=this.$props,t=E(r,["value","disabled"]),u={checked:this.checked,disabled:this.disabled,active:Boolean(this.state&v.Active)},c={id:this.id,ref:"el",role:"radio","aria-checked":this.checked?"true":"false","aria-labelledby":this.labelledby,"aria-describedby":this.describedby,"aria-disabled":this.disabled?!0:void 0,tabIndex:this.tabIndex,onClick:this.disabled?void 0:this.handleClick,onFocus:this.disabled?void 0:this.handleFocus,onBlur:this.disabled?void 0:this.handleBlur};return F({props:D({},t,c),slot:u,attrs:this.$attrs,slots:this.$slots,name:"RadioGroupOption"})},setup:function(r){var t=T("RadioGroupOption"),u="headlessui-radiogroup-option-"+L(),c=x({name:"RadioGroupLabel"}),i=_({name:"RadioGroupDescription"}),R=A(null),O=d(function(){return{value:r.value,disabled:r.disabled}}),p=A(v.Empty);W(function(){return t.registerOption({id:u,element:R,propsRef:O})}),V(function(){return t.unregisterOption(u)});var b=d(function(){var e;return((e=t.firstOption.value)==null?void 0:e.id)===u}),g=d(function(){return t.disabled.value||r.disabled}),k=d(function(){return m(t.value.value)===m(r.value)});return{id:u,el:R,labelledby:c,describedby:i,state:p,disabled:g,checked:k,tabIndex:d(function(){return g.value?-1:k.value||!t.containsCheckedOption.value&&b.value?0:-1}),handleClick:function(){var a;!t.change(r.value)||(p.value|=v.Active,(a=R.value)==null||a.focus())},handleFocus:function(){p.value|=v.Active},handleBlur:function(){p.value&=~v.Active}}}}),Y=K,Z=j;export{Q as R,Z as a,Y as b,X as c};
