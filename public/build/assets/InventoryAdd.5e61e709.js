import{S as G}from"./SearchInput.8d98e40e.js";import{L as Q}from"./LoadingState.36d08ac8.js";import{J as z}from"./ConfirmationModal.08e30afa.js";import{J as B}from"./DialogModal.15f17e82.js";import{_ as A}from"./plugin-vue_export-helper.21dcd24c.js";import{R as O,a as T,b as N,c as E}from"./radio-group.esm.f315fd9d.js";import{r as l,o as _,c as b,w as i,b as o,d,x as m,a as r,t as C,D as J,u as g,F,V as x,y as q,A as V,B as S,I as k,v as K}from"./app.c6d51eb6.js";import Y from"./InventoryMatchedList.0d40cce3.js";import"./Input.3e59ac9d.js";import"./Modal.a8ddeb0e.js";import"./SectionTitle.6e9e4bb1.js";import"./dom.esm.fa0fef86.js";import"./use-tree-walker.esm.683d9237.js";import"./description.esm.62a21e39.js";import"./label.esm.45c99648.js";import"./InventoryItem.a42755c4.js";const H={components:{RadioGroup:O,RadioGroupDescription:T,RadioGroupLabel:N,RadioGroupOption:E},props:{label:{type:String,default:"Select Option"},nameValue:{type:String,default:"name"},descriptionValue:{type:String,default:"description"},keyValue:{type:String,default:"id"},options:{type:[Array,Boolean],default:[]},selectedItem:{type:Object,default:null}},data(){return{selected:this.selectedItem}},watch:{selected(e){this.$emit("update",e)}}},P={class:"bg-white rounded-md -space-y-px"},W=r("span",{class:"rounded-full bg-white w-1.5 h-1.5"},null,-1),X=[W],Z={class:"ml-3 flex flex-col"};function $(e,n,u,j,t,a){const c=l("RadioGroupLabel"),f=l("RadioGroupDescription"),M=l("RadioGroupOption"),p=l("RadioGroup");return _(),b(p,{modelValue:t.selected,"onUpdate:modelValue":n[0]||(n[0]=h=>t.selected=h)},{default:i(()=>[o(c,{class:"sr-only"},{default:i(()=>[d(m(u.label),1)]),_:1}),r("div",P,[(_(!0),C(F,null,J(u.options,(h,I)=>(_(),b(M,{as:"template",key:h[u.keyValue],value:h},{default:i(({checked:y,active:v})=>[r("div",{class:g([I===0?"rounded-tl-md rounded-tr-md":"",I===u.options.length-1?"rounded-bl-md rounded-br-md":"",y?"bg-gray-50 border-gray-200 z-10":"border-gray-200","relative border p-4 flex cursor-pointer focus:outline-none"])},[r("span",{class:g([y?"bg-gray-600 border-transparent":"bg-white border-gray-300",v?"ring-2 ring-offset-2 ring-gray-500":"","h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center"]),"aria-hidden":"true"},X,2),r("div",Z,[o(c,{as:"span",class:g(["text-gray-900","block text-sm font-medium"])},{default:i(()=>[d(m(h[u.nameValue]),1)]),_:2},1032,["class"]),o(f,{as:"span",class:g([y?"text-gray-700":"text-gray-500","block text-sm"])},{default:i(()=>[d(m(h[u.descriptionValue]),1)]),_:2},1032,["class"])])],2)]),_:2},1032,["value"]))),128))])]),_:1},8,["modelValue"])}var ee=A(H,[["render",$]]);const te={components:{SearchInput:G,LoadingState:Q,ConfirmationModal:z,DialogModal:B,RadioListSelect:ee,InventoryMatchedList:Y},props:{order:{type:Object,required:!0}},data(){return{item:this.$inertia.form({inventory_id:null,order_item_id:null,quantity_removed:1}),loading:!0,inventory:[],confirm_quantity:!1,inventoryItem:null,matches:[],match:null,selectingMatch:!1,creatingMatch:!1,message:null,errored:!1}},computed:{unmatchedMatches(){return this.matches.filter(e=>!e.is_matched)},matchedMatches(){return this.matches.filter(e=>e.is_matched)},thereAreUnmatchedMatches(){return this.unmatchedMatches.length>0},needToConfirmQuantity(){var e;return((e=this.match)==null?void 0:e.unmatched_quantity)<this.item.quantity_removed},orderItemQuantity(){var e,n;return(n=(e=this.match)==null?void 0:e.quantity)!=null?n:0},quantityToAdd(){var e,n;return(n=(e=this.item)==null?void 0:e.quantity_removed)!=null?n:0},orderItemQuantityAfterAdding(){var e;return parseInt(this.quantityToAdd)-parseInt((e=this.match)==null?void 0:e.unmatched_quantity)+this.orderItemQuantity}},mounted(){this.getInventory()},watch:{selectingMatch(e){e&&this.$nextTick(()=>{document.getElementById("match").focus()})},creatingMatch(e){e&&this.$nextTick(()=>{document.getElementById("quantity-confirm").focus()})},match(e){e?this.item.order_item_id=e.id:this.item.order_item_id=null},"item.inventory_id"(){this.item.errors={},this.message=null,this.inventoryItem=null,this.match=null}},methods:{getInventory(){x.get(route("sales.inventory.index",this.order)).then(e=>{this.inventory=e.data}).catch(e=>{this.errored=!0,console.error(e)}).finally(()=>{this.loading=!1})},searchInventory(){x.get(route("sales.inventory.show",[this.order,this.item.inventory_id],{quantity:this.item.quantity_removed})).then(e=>{this.inventoryItem=e.data.inventory,this.message=e.data.message,this.matches=e.data.matches,this.match=e.data.match}).catch(e=>{this.errored=!0,this.message=e.response.data.message}).finally(()=>{var e;this.match&&this.inventoryItem.quantity==1?this.addInventory():((e=this.matches)==null?void 0:e.length)>0?this.showMatchOptions():this.inventoryItem&&this.showAddLineItemDialog()})},addInventory(){(this.match||this.creatingMatch)&&(this.item.transform(e=>({...e,confirm_quantity:this.confirm_quantity})).post(route("sales.inventory.store",this.order),{preserveState:!0,onSuccess:()=>{this.item.inventory_id=null,this.item.quantity_removed=1,this.match=null,this.creatingMatch=!1,this.selectingMatch=!1,this.$inertia.visit(route("orders.show",this.order),{preserveScroll:!0,onSuccess:()=>{document.getElementById("search").focus()}})}}),this.$emit("add",this.inventory))},confirmAddLineItem(){this.creatingMatch=!0,this.selectingMatch=!1},showMatchOptions(){this.selectingMatch=!0},showAddLineItemDialog(){this.creatingMatch=!0},updateMatch(e){this.match=e}}},ne=d(" Inventory Detail "),oe={class:"space-y-4 min-w-0 clear-both"},ie={class:"flex items-end space-x-2"},se={class:"form-control"},re=d("Inventory ID"),ae=d(" Add "),le={class:"border-t pt-4 mt-4"},de={class:"flex items-center justify-between mt-2"},me=d("Quantity:"),ce={class:"flex items-center justify-between"},ue=d(" Cancel "),he=d(" Yes, Add Item "),ye={class:"font-bold"},_e={class:"mt-2 grid gap-4"},fe={class:"flex items-center justify-between mt-2"},pe=d("Quantity:"),ve={key:0,class:"flex items-center mb-2"},ge={class:"flex flex-col space-y-2 md:space-y-0 md:flex-row items-center md:justify-between"},be=d(" Cancel "),Ie=d(" Add New Order Line Item"),Me=d(" Match Item ");function qe(e,n,u,j,t,a){const c=l("jet-input-error"),f=l("jet-label"),M=l("search-input"),p=l("jet-button"),h=l("InventoryMatchedList"),I=l("loading-state"),y=l("jet-input"),v=l("jet-secondary-button"),L=l("confirmation-modal"),w=l("RadioListSelect"),R=l("jet-checkbox"),D=l("dialog-modal"),U=l("details-section");return _(),b(U,{class:"w-full"},{title:i(()=>[ne]),default:i(()=>[r("div",oe,[r("form",{onSubmit:n[2]||(n[2]=q((...s)=>a.searchInventory&&a.searchInventory(...s),["prevent"])),class:"grid sticky top-0 bg-white p-1 pt-0 z-10"},[r("div",null,[V(o(c,{class:"mb-2",message:t.message},null,8,["message"]),[[S,!t.selectingMatch]]),V(o(c,{class:"mb-2",message:t.item.errors.quantity_removed},null,8,["message"]),[[S,!t.selectingMatch]])]),r("div",ie,[r("div",se,[o(f,{for:"search"},{default:i(()=>[re]),_:1}),o(M,{onFocus:n[0]||(n[0]=s=>s.target.select()),placeholder:"Search by Inventory ID",required:"",modelValue:t.item.inventory_id,"onUpdate:modelValue":n[1]||(n[1]=s=>t.item.inventory_id=s)},null,8,["modelValue"])]),o(p,{type:"submit",class:"text-center"},{default:i(()=>[ae]),_:1})])],32),o(h,{inventory:t.inventory,order:u.order},null,8,["inventory","order"]),o(I,{loading:t.loading},null,8,["loading"])]),o(L,{onClose:n[6]||(n[6]=s=>t.creatingMatch=!1),show:t.creatingMatch},{title:i(()=>[d(" Add "+m(t.inventoryItem.product.name)+"?",1)]),content:i(()=>[r("form",{onKeydown:n[4]||(n[4]=k(q((...s)=>a.addInventory&&a.addInventory(...s),["prevent"]),["enter"]))},[d(" Do you want to add a new line item of "+m(t.inventoryItem.product.name)+" in size "+m(t.inventoryItem.size.name)+" to the order? ",1),r("div",le,[o(c,{message:t.item.errors.quantity_removed},null,8,["message"]),r("div",de,[o(f,{class:"font-bold",for:"quantity-confirm"},{default:i(()=>[me]),_:1}),o(y,{type:"number",id:"quantity-confirm",modelValue:t.item.quantity_removed,"onUpdate:modelValue":n[3]||(n[3]=s=>t.item.quantity_removed=s),modelModifiers:{number:!0},error:!!t.item.errors.quantity_removed},null,8,["modelValue","error"])])])],32)]),footer:i(()=>[r("div",ce,[o(v,{type:"button",onClick:n[5]||(n[5]=s=>t.creatingMatch=!1)},{default:i(()=>[ue]),_:1}),o(p,{type:"submit",disabled:!t.creatingMatch,onClick:a.addInventory},{default:i(()=>[he]),_:1},8,["disabled","onClick"])])]),_:1},8,["show"]),o(D,{onClose:n[13]||(n[13]=s=>t.selectingMatch=!1),show:t.selectingMatch},{title:i(()=>[d(m(this.thereAreUnmatchedMatches?"Select order item to match":"Select order item to match and increase quantity of"),1)]),description:i(()=>[r("div",null," Select the order item to match ID #"+m(t.inventoryItem.id)+" inventory item: "+m(t.inventoryItem.product.name)+" in size "+m(t.inventoryItem.size.name)+" to. ",1),r("div",ye,m(this.thereAreUnmatchedMatches?"":"This will increase the quantity of the order item."),1)]),content:i(()=>[r("form",{onKeydown:n[11]||(n[11]=k(q((...s)=>a.addInventory&&a.addInventory(...s),["prevent"]),["enter"]))},[o(c,{class:"mb-4 px-1",message:t.message},null,8,["message"]),a.thereAreUnmatchedMatches?(_(),b(w,{key:0,modelValue:t.match,"onUpdate:modelValue":n[7]||(n[7]=s=>t.match=s),id:"match",label:"Select Match",nameValue:"product_name",descriptionValue:"size_name",options:a.unmatchedMatches,selectedItem:t.match,onUpdate:a.updateMatch,class:"mb-4"},null,8,["modelValue","options","selectedItem","onUpdate"])):(_(),b(w,{key:1,modelValue:t.match,"onUpdate:modelValue":n[8]||(n[8]=s=>t.match=s),id:"match",label:"Select Match",nameValue:"product_name",descriptionValue:"size_name",options:a.matchedMatches,selectedItem:t.match,onUpdate:a.updateMatch,class:"mb-4"},null,8,["modelValue","options","selectedItem","onUpdate"])),r("div",_e,[r("div",null,[o(c,{message:t.item.errors.quantity_removed},null,8,["message"]),r("div",fe,[o(f,{class:"font-bold",for:"quantity"},{default:i(()=>[pe]),_:1}),o(y,{id:"quantity",type:"number",error:!!t.item.errors.quantity_removed,modelValue:t.item.quantity_removed,"onUpdate:modelValue":n[9]||(n[9]=s=>t.item.quantity_removed=s),modelModifiers:{number:!0}},null,8,["error","modelValue"])])]),r("div",null,[a.needToConfirmQuantity?(_(),C("div",ve,[o(f,{class:g({"text-red-500":a.needToConfirmQuantity&&!t.confirm_quantity}),for:"confirm_quantity"},{default:i(()=>[d("Increase quantity of order item from "+m(a.orderItemQuantity)+" to "+m(a.orderItemQuantityAfterAdding)+"?",1)]),_:1},8,["class"]),o(R,{id:"confirm_quantity",modelValue:t.confirm_quantity,"onUpdate:modelValue":n[10]||(n[10]=s=>t.confirm_quantity=s)},null,8,["modelValue"])])):K("",!0),o(c,{message:t.item.errors.confirm_quantity},null,8,["message"])])])],32)]),footer:i(()=>[r("div",ge,[o(v,{type:"button",onClick:n[12]||(n[12]=s=>t.selectingMatch=!1)},{default:i(()=>[be]),_:1}),o(v,{type:"button",onClick:a.confirmAddLineItem,class:"md:mr-auto md:ml-2"},{default:i(()=>[Ie]),_:1},8,["onClick"]),o(p,{type:"submit",disabled:!t.match,onClick:a.addInventory},{default:i(()=>[Me]),_:1},8,["disabled","onClick"])])]),_:1},8,["show"])]),_:1})}var Oe=A(te,[["render",qe]]);export{Oe as default};
