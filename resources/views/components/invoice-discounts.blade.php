 @if ($invoice->areDiscountLineItems())
     <table class="table table-items">

         <thead>
             <tr>
                 <th scope="col" colspan="{{ $invoice->table_columns }}" class="border-0 pl-0">Discounts</th>
                 <th scope="col" class="text-right border-0 pr-0"></th>
             </tr>
         </thead>


         <tbody>
             {{-- Items --}}
             @foreach ($invoice->discounts as $item)
                 <tr>
                     <td colspan="{{ $invoice->table_columns }}" class="pl-0">
                         {{ $item->title }}

                         @if ($item->description)
                             <p class="cool-gray">{{ $item->description }}</p>
                         @endif
                     </td>
                     <td class="text-right pr-0">
                         {{ $invoice->formatCurrency($item->amount) }}
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 @endif
