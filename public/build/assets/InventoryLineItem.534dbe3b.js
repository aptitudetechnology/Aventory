import{T as r}from"./TableD.bf7ad4fd.js";import{_ as h,r as s,o as b,J as k,b as e,w as l,d as a,N as i}from"./app.9dc34ef4.js";const y={components:{TableD:r},props:{item:Object,itemSelected:Boolean},data(){return{selected:this.itemSelected}},emits:["selected"],watch:{itemSelected(){this.selected=this.itemSelected}}},v={tabindex:"0",class:"px-2"},S=a("Select"),j=a("Edit");function w(o,c,t,x,m,D){const u=s("jet-label"),_=s("jet-checkbox"),n=s("table-d"),f=s("Link");return b(),k("tr",v,[e(n,{class:"sticky left-0 bg-white"},{default:l(()=>[e(u,{class:"sr-only",for:"item-selected"+t.item.id},{default:l(()=>[S]),_:1},8,["for"]),e(_,{id:"item-selected"+t.item.id,onChange:c[0]||(c[0]=d=>o.$emit("selected")),value:t.item.id,modelValue:m.selected,"onUpdate:modelValue":c[1]||(c[1]=d=>m.selected=d),checked:m.selected},null,8,["id","value","modelValue","checked"])]),_:1}),e(n,null,{default:l(()=>[a(i(t.item.id),1)]),_:1}),e(n,null,{default:l(()=>[a(i(t.item.quantity),1)]),_:1}),e(n,null,{default:l(()=>[a(i(o.formatDate(t.item.created_at)),1)]),_:1}),e(n,null,{default:l(()=>[a(i(o.formatDate(t.item.updated_at)),1)]),_:1}),e(n,null,{default:l(()=>[a(i(t.item.product.name),1)]),_:1}),e(n,null,{default:l(()=>[a(i(t.item.size.name),1)]),_:1}),e(n,null,{default:l(()=>{var d;return[a(i((d=t.item.nursery_location)==null?void 0:d.location_code),1)]}),_:1}),e(n,null,{default:l(()=>[a(i(t.item.block.BlockDisplayName),1)]),_:1}),e(n,null,{default:l(()=>[a(i(t.item.place_name),1)]),_:1}),e(n,null,{default:l(()=>[e(f,{href:o.route("inventory.show",t.item.id),class:"link"},{default:l(()=>[j]),_:1},8,["href"])]),_:1})])}var N=h(y,[["render",w]]);export{N as default};
