<?php

namespace App\Classes;

use App\Services\PricingService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;

class Invoice extends \LaravelDaily\Invoices\Invoice
{
  /**
   * @var Collection
   */
  public $discounts;

  public $warranty_amount;

  public $sub_total;

  /**
   * Invoice constructor.
   *
   * @throws BindingResolutionException
   */
  public function __construct()
  {
    parent::__construct();
    $this->discounts = Collection::make([]);
  }

  /**
   * @return $this
   */
  public function addDiscount(DiscountItem $item): Invoice
  {
    $this->discounts->push($item);

    return $this;
  }

  /**
   * @param $items
   *
   * @return $this
   */
  public function addDiscountItems($items): Invoice
  {
    foreach ($items as $item) {
      $this->addDiscount($item);
    }

    return $this;
  }

  public function areDiscountLineItems(): bool
  {
    return count($this->discounts) > 0;
  }

  public function hasItemOrInvoiceDiscount()
  {
    return $this->areDiscountLineItems() && $this->hasDiscount();
  }

  public function warrantyAmount(float $amount)
  {
    $this->warranty_amount = $amount;

    return $this;
  }

  public function hasWarranty()
  {
    return $this->warranty_amount > 0;
  }

  public function subTotal(float $amount)
  {
    $this->sub_total = $amount;

    return $this;
  }

  /**
   * @return $this
   */
  protected function calculate()
  {
    $total_amount   = null;
    $total_discount = null;
    $total_taxes    = null;
    $warranty_amount = null;

    $this->items->each(
      function ($item) use (&$total_amount, &$total_discount, &$total_taxes) {
        // Gates
        if ($item->hasTax() && $this->hasTax()) {
          throw new Exception('Invoice: you must have taxes only on items or only on invoice.');
        }

        if ($item->hasDiscount() && $this->hasDiscount()) {
          throw new Exception('Invoice: you must have discounts only on items or only on invoice.');
        }

        $item->calculate($this->currency_decimals);

        (!$item->hasUnits()) ?: $this->hasItemUnits = true;

        if ($item->hasDiscount()) {
          $total_discount += $item->discount;
          $this->hasItemDiscount = true;
        }

        if ($item->hasTax()) {
          $total_taxes += $item->tax;
          $this->hasItemTax = true;
        }

        // Totals
        $total_amount += $item->sub_total_price;
      }
    );

    $this->applyColspan();

    /*
         * Apply calculations for provided overrides with:
         * totalAmount(), totalDiscount(), discountByPercent(), totalTaxes(), taxRate()
         * or use values calculated from items.
         */
    $this->hasTotalAmount() ?: $this->total_amount                            = $total_amount;
    $this->hasDiscount() ? $this->calculateDiscount() : $this->total_discount = $total_discount;
    $this->hasWarranty() ? $this->calculateWarranty() : $this->warranty_amount = $warranty_amount;
    $this->hasTax() ? $this->calculateTax() : $this->total_taxes              = $total_taxes;

    !$this->hasShipping() ?: $this->calculateShipping();

    return $this;
  }

  public function calculateWarranty(): void
  {
    $this->total_amount = PricingService::applyTax($this->total_amount, $this->warranty_amount, $this->currency_decimals);
  }
}
