import{j as _,p as g,v as j,f as C,g as k,m as b,Z as O,h as y,D as S,k as E,i as P,A as T}from"./app.9dc34ef4.js";var h=Symbol("LabelContext");function $(){var s=P(h,null);if(s===null){var e=new Error("You used a <Label /> component, but it is not inside a parent.");throw Error.captureStackTrace&&Error.captureStackTrace(e,$),e}return s}function I(s){var e=s===void 0?{}:s,t=e.slot,u=t===void 0?{}:t,o=e.name,l=o===void 0?"Label":o,n=e.props,p=n===void 0?{}:n,r=_([]);function c(a){return r.value.push(a),function(){var i=r.value.indexOf(a);i!==-1&&r.value.splice(i,1)}}return g(h,{register:c,slot:u,name:l,props:p}),j(function(){return r.value.length>0?r.value.join(" "):void 0})}var W=C({name:"Label",props:{as:{type:[Object,String],default:"label"},passive:{type:[Boolean],default:!1}},render:function(){var e=this.context,t=e.name,u=t===void 0?"Label":t,o=e.slot,l=o===void 0?{}:o,n=e.props,p=n===void 0?{}:n,r=this.$props,c=r.passive,a=k(r,["passive"]),i=b({},Object.entries(p).reduce(function(m,f){var d,x=f[0],L=f[1];return Object.assign(m,(d={},d[x]=O(L),d))},{}),{id:this.id}),v=b({},a,i);return c&&delete v.onClick,y({props:v,slot:l,attrs:this.$attrs,slots:this.$slots,name:u})},setup:function(){var e=$(),t="headlessui-label-"+T();return S(function(){return E(e.register(t))}),{id:t,context:e}}});export{W as L,I as u};
