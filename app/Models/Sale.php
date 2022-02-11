<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Classes\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Classes\DiscountItem;

class Sale extends Model
{
  use HasFactory;
  protected $with = ['customer', 'teamMember'];
  protected $appends = ['total_of_items_with_discount', 'type', 'name', 'full_name', 'route'];
  protected $table = 'orders';
  protected $guarded = [];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'id' => 'integer',
    'date' => 'date:Y-m-d',
    'quote_expires' => 'date:Y-m-d',
    'hold_inventory' => 'boolean',
    'customer_id' => 'integer',
    'contact_id' => 'integer',
    'team_member_id' => 'integer',
    'team_id' => 'integer',
    'delivery_status_id' => 'integer',
    'payment_status_id' => 'integer',
    'quote_id' => 'integer',
    'is_taxable' => 'boolean',
    'is_quote' => 'boolean',
    'total' => 'float',
    'tax_amount' => 'float',
    'total_after_discount_and_warranty' => 'float',
    'total_of_items_with_discount' => 'float',
    'total_discounts' => 'float',
    'warranty_amount' => 'float',
    'grand_total' => 'float',
  ];

  public function getTypeAttribute()
  {
    return $this->is_quote ? 'Quote' : 'Order';
  }

  public function getNameAttribute(): string
  {
    return $this->is_quote ? "Quote #{$this->id}" : "Order #{$this->id}";
  }

  public  function getFullNameAttribute(): string
  {
    return $this->name .  ($this->customer ? " - {$this->customer->name}" : '');
  }

  public function getTaxRateAttribute()
  {
    return $this->is_taxable && $this->tax_percentage ? $this->tax_percentage : 0;
  }

  public function getShippingAmountAttribute($value)
  {
    return $value ? $value : 0;
  }

  public function getRouteAttribute()
  {
    return $this->is_quote ? 'quotes.show' : 'orders.show';
  }

  public function team()
  {
    return $this->belongsTo(Team::class, 'team_id');
  }

  public function teamMember()
  {
    return $this->belongsTo(User::class, 'team_member_id');
  }

  /**
   * Get the discounts for the order.
   * Need to add for foreign key since the quote model is an extension of the order model.
   */
  public function discounts()
  {
    return $this->hasMany(OrderDiscount::class, 'order_id');
  }

  public function appliedDiscounts()
  {
    return $this->discounts()->where('discount_applied', true);
  }

  /**
   * Get the order items inventory.
   * Group by order item.
   */
  public function inventory()
  {
    $inventory = $this->items->map(function ($item) {
      return [
        'id' => $item->id,
        'product_name' => $item->product->name,
        'size_name' => $item->size->name,
        'is_matched' => $item->is_matched,
        'quantity' => $item->quantity,
        'unmatched_quantity' => $item->unmatched_quantity,
        'archived_inventory' => $item->archived,
      ];
    });
    return $inventory;
  }

  public function doesntHaveInventory(): bool
  {
    return $this->items->every(function ($item) {
      return $item->matched_quantity === 0;
    });
  }

  /**
   * Get items in the order.
   */
  public function items()
  {
    return $this->hasMany(OrderItem::class, 'order_id');
  }

  /**
   *
   * Get the is_completed attribute.
   *
   */
  public function getReadyToCompleteAttribute()
  {
    // Run through the order items and check if any are not completed.
    return $this->items->every(function ($item) {
      return $item->is_matched;
    });
  }


  /**
   *
   * Get item matched to inventory.
   */
  public function getItemMatchedToInventory(Inventory $inventory)
  {
    return $this->items->filter(function ($item) use ($inventory) {
      return $item->inventory->contains($inventory);
    })->first();
  }

  /*
    * Get order item match that is same of scanned inventory.
    */
  public function getPerfectInventoryMatchForItem(Inventory $inventory)
  {
    $item = $this->items
      ->where('product_id', $inventory->product_id)
      ->where('size_id', $inventory->size_id)
      ->filter(function ($item) {
        return !$item->is_matched;
      })->first();
    return $item;
  }

  /**
   * Get possible order item matches that is same of scanned inventory.
   */
  public function getPossibleInventoryItemMatches(Inventory $inventory)
  {
    $items = $this->items()->where('product_id', $inventory->product_id)->get()->append('is_matched')->flatten();
    return $items;
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class)->withTrashed();
  }

  public function contact()
  {
    return $this->belongsTo(Contact::class);
  }

  public function getDiscountPercentageAttribute()
  {
    return $this->discounts->sum('percentage');
  }

  public function getTotalOfItemsWithDiscountAttribute()
  {
    return $this->items()->where('no_discount', false)->sum(DB::raw('quantity * unit_price'));
  }

  public function setTotalAttribute()
  {
    $this->attributes['total'] =
      $this->items->reduce(function ($total, $item) {
        return $total + ($item->line_total);
      }, 0);
  }

  public function setTotalDiscountsAttribute()
  {
    $this->attributes['total_discounts'] =
      $this->discounts()->where('discount_applied', true)->get()->reduce(function ($total, $item) {
        return $total + ($item->discount_total);
      }, 0);
  }

  public function setWarrantyAmmountAttribute()
  {
    $this->attributes['warranty_amount'] = ($this->warranty_percentage / 100) * $this->total;
  }

  public function setTotalAfterDiscountAndWarrantyAttribute()
  {
    $this->attributes['total_after_discount_and_warranty'] = $this->total - $this->total_discounts + $this->warranty_amount;
  }

  public function setTaxAmountAttribute()
  {
    $this->attributes['tax_amount'] = $this->total_after_discount_and_warranty * ($this->tax_percentage / 100);
  }

  public function getShippingTaxAmountAttribute()
  {
    return ($this->tax_percentage / 100) * $this->shipping_amount;
  }

  public function setGrandTotalAttribute()
  {
    $this->attributes['grand_total'] = $this->total_after_discount_and_warranty + $this->tax_amount + $this->shipping_amount;
  }

  public function setTaxPercentage()
  {
    $this->attributes['tax_percentage'] = $this->customer->tax_percentage;
    $this->save();
  }

  public function updateTotals()
  {
    $this->setTotalAttribute();
    $this->setWarrantyAmmountAttribute();
    $this->setTotalDiscountsAttribute();
    $this->setTotalAfterDiscountAndWarrantyAttribute();
    $this->setTaxAmountAttribute();
    $this->setGrandTotalAttribute();
    $this->save();
  }

  public function createCustomerDiscount()
  {
    $order = $this->fresh('customer');
    if ($order->customer->discount_percentage) {
      $order->discounts()->create([
        'description' => "Discount of {$order->customer->discount_percentage}% will be applied to eligible products if paid within invoice terms.",
        'discount_percentage' => $order->customer->discount_percentage,
      ]);
    }
  }

  public function updateDiscounts()
  {
    if ($this->wasChanged('customer_id')) {
      $this->discounts()->delete();
      $this->createCustomerDiscount();
    }
  }

  public function generatePDF($template = 'default')
  {
    $seller = new Party([
      'name' => $this->team->name,
      'address' => $this->team->address,
      'phone' => $this->team->phone,
    ]);

    $customer = new Buyer([
      'name' => $this->customer->name,
      'address' => $this->customer->address,
    ]);



    $items = $this->items->map(function ($item) {
      return (new InvoiceItem())
        ->title($item->product_name)
        ->units($item->size->name)
        ->quantity($item->quantity)
        ->pricePerUnit($item->unit_price);
    });

    $discounts = $this->appliedDiscounts->map(function ($discount) {
      return (new DiscountItem())
        ->title($discount->title)
        ->description($discount->description)
        ->amount($discount->discount_total);
    });

    $notes = $this->notes ? $this->notes : '';

    $invoice = Invoice::make()
      ->template($template)
      ->name($this->name)
      ->sequence($this->id)
      ->seller($seller)
      ->buyer($customer)
      ->payUntilDays(30)
      ->filename($this->team->name . '/' . $this->full_name)
      ->notes($notes)
      ->addItems($items)
      ->addDiscounts($discounts)
      ->subTotal($this->total)
      ->warrantyAmount($this->warranty_amount)
      ->taxRate($this->tax_rate)
      ->isTaxable($this->is_taxable)
      ->shipping($this->shipping_amount)
      ->totalDiscount($this->total_discounts)
      ->save('public');

    return $invoice;
  }

  public static function convert(Sale $sale, $items)
  {
    $newSale = $sale->replicate()->fill([
      'is_quote' => !$sale->is_quote,
      'from_quote_id' => $sale->is_quote ? $sale->id : null,
    ]);
    $newSale->save();
    $newSale->updateTotals();

    foreach ($items as $item) {
      $oldItem = $sale->items()->where('id', $item['id'])->first();

      $newItem = $oldItem->replicate()->fill([
        'order_id' => $newSale->id,
        'quantity_fulfilled' => 0,
        'quantity' => $item['quantity'],
      ]);
      $newItem->save();

      if ($sale->is_quote) {
        $oldItem->quantity_fulfilled += $item['quantity'];
        $oldItem->save();
      }
    }


    foreach ($sale->discounts as $discount) {
      $newDiscount = $discount->replicate()
        ->fill([
          'order_id' => $newSale->id,
        ]);
      $newDiscount->save();
    }

    return $newSale;
  }
}