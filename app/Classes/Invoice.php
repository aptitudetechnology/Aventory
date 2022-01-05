<?php

namespace App\Classes;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Collection;

class Invoice extends \LaravelDaily\Invoices\Invoice
{
  /**
   * @var Collection
   */
  public $discounts;

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
}
