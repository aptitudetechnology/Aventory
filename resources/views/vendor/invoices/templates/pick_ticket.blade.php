<x-invoice-layout :invoice="$invoice">
    {{-- Seller - Buyer --}}
    <table class="table">
        <tbody>
            <tr>
                <td class="px-0">
                    @if ($invoice->buyer->name)
                        <p class="buyer-name">
                            <strong>{{ $invoice->buyer->name }}</strong>
                        </p>
                    @endif

                    @if ($invoice->buyer->address)
                        <p class="buyer-address">
                            {{ __('invoices::invoice.address') }}: {{ $invoice->buyer->address }}
                        </p>
                    @endif

                    @if ($invoice->buyer->code)
                        <p class="buyer-code">
                            {{ __('invoices::invoice.code') }}: {{ $invoice->buyer->code }}
                        </p>
                    @endif

                    @if ($invoice->buyer->vat)
                        <p class="buyer-vat">
                            {{ __('invoices::invoice.vat') }}: {{ $invoice->buyer->vat }}
                        </p>
                    @endif

                    @if ($invoice->buyer->phone)
                        <p class="buyer-phone">
                            {{ __('invoices::invoice.phone') }}: {{ $invoice->buyer->phone }}
                        </p>
                    @endif

                    @foreach ($invoice->buyer->custom_fields as $key => $value)
                        <p class="buyer-custom-field">
                            {{ ucfirst($key) }}: {{ $value }}
                        </p>
                    @endforeach
                </td>
                <td class="border-0"></td>
                <td class="px-0">
                    @if ($invoice->seller->name)
                        <p class="seller-name">
                            <strong>{{ $invoice->seller->name }}</strong>
                        </p>
                    @endif

                    @if ($invoice->seller->address)
                        <p class="seller-address">
                            {{ __('invoices::invoice.address') }}: {{ $invoice->seller->address }}
                        </p>
                    @endif

                    @if ($invoice->seller->code)
                        <p class="seller-code">
                            {{ __('invoices::invoice.code') }}: {{ $invoice->seller->code }}
                        </p>
                    @endif

                    @if ($invoice->seller->vat)
                        <p class="seller-vat">
                            {{ __('invoices::invoice.vat') }}: {{ $invoice->seller->vat }}
                        </p>
                    @endif

                    @if ($invoice->seller->phone)
                        <p class="seller-phone">
                            {{ __('invoices::invoice.phone') }}: {{ $invoice->seller->phone }}
                        </p>
                    @endif

                    @foreach ($invoice->seller->custom_fields as $key => $value)
                        <p class="seller-custom-field">
                            {{ ucfirst($key) }}: {{ $value }}
                        </p>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Table Items --}}
    <x-invoice-items :showPrice="false" :invoice="$invoice" />

    {{-- Table Footer --}}
    @if ($invoice->notes)
        <p>
            {{ trans('invoices::invoice.notes') }}: {!! $invoice->notes !!}
        </p>
    @endif

</x-invoice-layout>
