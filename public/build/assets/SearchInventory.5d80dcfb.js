import{_ as u,a0 as c,a2 as p,a4 as m,a5 as h,ah as n,r as s,o as f,J as b,b as i,w as I,O as _,d as v}from"./app.123e766a.js";import{S}from"./SearchInput.993ac6a1.js";const g={components:{JetButton:c,JetInput:p,JetInputError:m,JetLabel:h,SearchInput:S},data(){return{id:"",loading:!1}},methods:{searchInventory(){n.Inertia.get(route("inventory.show",this.id))},updateLoadingState(){n.Inertia.on("start",()=>{this.loading=!0}),n.Inertia.on("finish",o=>{this.loading=!1})}},mounted(){this.updateLoadingState()}},x=v("Search");function y(o,e,w,J,t,r){const d=s("SearchInput"),l=s("jet-button");return f(),b("form",{onSubmit:e[1]||(e[1]=_((...a)=>r.searchInventory&&r.searchInventory(...a),["prevent"])),class:"flex items-center space-x-2 max-w-lg"},[i(d,{modelValue:t.id,"onUpdate:modelValue":e[0]||(e[0]=a=>t.id=a),class:"mt-0 w-full",ref:"search",autofocus:!o.route().current("inventory.index"),disabled:t.loading,placeholder:"Search by plant id",title:"Must be a valid id",inputmode:"numeric",pattern:"\\d*"},null,8,["modelValue","autofocus","disabled"]),i(l,{type:"submit",disabled:!t.id},{default:I(()=>[x]),_:1},8,["disabled"])],32)}var L=u(g,[["render",y]]);export{L as default};
