import{o as s,c,b as o,_,ao as h,r as x,J as i,a as e,W as u,X as f,N as n}from"./app.9dc34ef4.js";function v(a,r){return s(),c("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[o("path",{"fill-rule":"evenodd",d:"M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z","clip-rule":"evenodd"})])}function p(a,r){return s(),c("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[o("path",{"fill-rule":"evenodd",d:"M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z","clip-rule":"evenodd"})])}function g(a,r){return s(),c("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[o("path",{d:"M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"})])}const w={components:{CalendarIcon:v,LocationMarkerIcon:p,UsersIcon:g},props:{orders:{type:Object}},methods:{formatDate:a=>h(a).format("MM/DD/YYYY")}},y={class:"bg-white shadow overflow-hidden sm:rounded-md"},k={role:"list",class:"divide-y divide-gray-200"},M={href:"#",class:"block hover:bg-gray-50"},b={class:"px-4 py-4 sm:px-6"},z={class:"flex items-center justify-between"},B={class:"text-sm font-medium text-indigo-600 truncate"},C={class:"ml-2 flex-shrink-0 flex"},I={class:"px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"},V={class:"mt-2 sm:flex sm:justify-between"},$={class:"sm:flex"},D={class:"flex items-center text-sm text-gray-500"},H={class:"mt-2 flex items-center text-sm text-gray-500 sm:mt-0"},L=["datetime"],Y={class:"mt-2 flex items-center text-sm text-gray-500 sm:mt-0"},j=["datetime"];function N(a,r,m,O,S,A){const d=x("CalendarIcon");return s(),i("div",y,[e("ul",k,[(s(!0),i(u,null,f(m.orders.data,t=>{var l;return s(),i("li",{key:t.id},[e("a",M,[e("div",b,[e("div",z,[e("p",B,n(t.customer.name),1),e("div",C,[e("p",I,n((l=t.paymentStatus)==null?void 0:l.name),1)])]),e("div",V,[e("div",$,[e("p",D," # "+n(t.id),1),e("div",H,[o(d,{class:"flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400","aria-hidden":"true"}),e("p",null,[e("time",{datetime:t.date},n(t.date),9,L)])])]),e("div",Y,[o(d,{class:"flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400","aria-hidden":"true"}),e("p",null,[e("time",{datetime:t.date},n(t.date),9,j)])])])])])])}),128))])])}var F=_(w,[["render",N]]);export{F as default};
