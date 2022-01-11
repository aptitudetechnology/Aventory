    <table class="table totals-table table-items">
        <thead>
            <tr>
                <th scope="col" colspan="{{ $invoice->table_columns }}" class="border-0 pl-0">Total</th>
                <th scope="col" class="text-right border-0 pr-0"></th>
            </tr>
        </thead>
        <tbody>
            {{-- Summary --}}
            <tr>
                <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                <td class="text-right pl-0">{{ __('invoices::invoice.sub_total') }}</td>
                <td class="text-right pr-0">
                    {{ $invoice->formatCurrency($invoice->sub_total) }}
                </td>
            </tr>
            @if ($invoice->hasItemOrInvoiceDiscount())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.total_discount') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->total_discount) }}
                    </td>
                </tr>
            @endif
            @if ($invoice->hasWarranty())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.total_warranty') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->warranty_amount) }}
                    </td>
                </tr>
            @endif
            @if ($invoice->taxable_amount && $invoice->is_taxable)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                    <td class="text-right ">{{ __('invoices::invoice.taxable_amount') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                    </td>
                </tr>
            @endif
            @if ($invoice->tax_rate && $invoice->is_taxable)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.tax_rate') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->tax_rate }}%
                    </td>
                </tr>
            @endif
            @if ($invoice->hasItemOrInvoiceTax() && $invoice->is_taxable)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->total_taxes) }}
                    </td>
                </tr>
            @endif
            @if ($invoice->shipping_amount)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                    <td class="text-right pl-0">{{ __('invoices::invoice.shipping') }}</td>
                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($invoice->shipping_amount) }}
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="{{ $invoice->table_columns - 1 }}" class="border-0"></td>
                <td class="text-right pl-0">{{ __('invoices::invoice.total_amount') }}</td>
                <td class="text-right pr-0 total-amount">
                    {{ $invoice->formatCurrency($invoice->total_amount) }}
                </td>
            </tr>
        </tbody>
    </table>
