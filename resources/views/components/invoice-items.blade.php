    <table class="table table-items">
        <thead>
            <tr>
                <th scope="col" class="border-0 pl-0">{{ __('invoices::invoice.description') }}</th>
                @if ($invoice->hasItemUnits)
                    <th scope="col" class="text-center border-0">{{ __('invoices::invoice.units') }}</th>
                @endif
                <th scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                <th scope="col" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                @if ($invoice->hasItemDiscount)
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</th>
                @endif
                @if ($invoice->hasItemTax)
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</th>
                @endif
                <th scope="col" class="text-right border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</th>
            </tr>
        </thead>
        <tbody>
            {{-- Items --}}
            @foreach ($invoice->items as $item)
                <tr>
                    <td class="pl-0">
                        {{ $item->title }}

                        @if ($item->description)
                            <p class="cool-gray">{{ $item->description }}</p>
                        @endif
                    </td>
                    @if ($invoice->hasItemUnits)
                        <td class="text-center">{{ $item->units }}</td>
                    @endif
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    @if ($invoice->hasItemDiscount)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->discount) }}
                        </td>
                    @endif
                    @if ($invoice->hasItemTax)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->tax) }}
                        </td>
                    @endif

                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
