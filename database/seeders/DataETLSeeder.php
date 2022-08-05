<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Faker\Generator;
use Illuminate\Container\Container;

use App\Models\Category;
use App\Models\Size;
use App\Models\Team;
use App\Models\NurseryLocation;
use App\Models\Block;
use App\Models\Place;
use App\Models\Customer;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Price;
use App\Models\Plant;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderDiscount;
use App\Models\ShippingMethod;
use App\Models\CustomerPriceLevel;
use App\Models\Inventory;
use App\Models\InventoryArchive;

class DataETLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->team = NULL;
        $this->op_bulk_count = 2000;
        $this->sqlsrv_conn = DB::connection('sqlsrv');
        $this->faker = $this->withFaker();
    }

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        $this->fresh_db();

        $this->do_ETL_users();

        // // Create Garden Gate Nursery team
        $this->team = $this->create_team();
        $this->seed_nursery_locations();

        $this->do_ETL_categories();
        $this->do_ETL_sizes();
        $this->do_ETL_blocks();
        $this->do_ETL_places();
        $this->do_ETL_products();
        $this->do_ETL_prices();

        $this->do_ETL_customer_price_levels();
        $this->do_ETL_customers();

        $this->do_ETL_vendors();
        $this->do_ETL_purchases();
        $this->do_ETL_purchases_items();
        $this->do_ETL_shipping_methods();

        $this->do_ETL_orders();
        $this->do_ETL_order_items();
        $this->do_ETL_order_discounts();

        $this->do_ETL_inventories();
        $this->do_ETL_inventory_archive();
    }

    public function bulk_insert($model, $data, $id_seq_name = null, $id_seq_value = null)
    {
        $op_bulk_count = $this->op_bulk_count;
        $cnt = count($data);
        for ($i = 0 ; $i <= $cnt / $op_bulk_count; $i++)
        {
            $model::insert(array_slice($data, $i * $op_bulk_count, $op_bulk_count));
        }

        if ($id_seq_name && $id_seq_value)
            DB::statement("ALTER SEQUENCE " . $id_seq_name . " RESTART WITH " . $id_seq_value);
    }

    public function fresh_db()
    {
        echo "Fresh the database...\n";
        Artisan::call('migrate:fresh');
        echo "Freshed the database successfully!\n";
    }

    public function create_team()
    {
        $init_user = User::factory()->create([
            'email' => 'teststuff@gmail.com'
        ]);

        return Team::factory()->create([
            'name' => 'Garden Gate Nursery',
            'user_id' => $init_user->id
        ]);
    }
    
    public function do_ETL_categories()
    {
        echo "Processing ETL of categories...\n";
        $old_categories = $this->sqlsrv_conn->table('TblCategories')->get()->toArray();
        $new_categories = array_map(function($category) {
            return [
                'id' => $category->CategoryID,
                'name' => $category->Category,
                'team_id' => $this->team->id
            ];
        }, $old_categories);

        $last_id = $this->sqlsrv_conn->table('TblCategories')->max('CategoryID');
        $this->bulk_insert(Category::class, $new_categories, 'categories_id_seq', $last_id + 1);
        echo "Finished ETL of categories successfully!!!\n\n";
    }

    public function do_ETL_sizes()
    {
        echo "Processing ETL of sizes...\n";
        $old_sizes = $this->sqlsrv_conn->table('TblProductSizes')->get()->toArray();
        $new_sizes = array_map(function($size) {
            return [
                'id' => $size->SizeID,
                'name' => $size->Description,
                'next_size_id' => $size->NextSizeID,
                'sort_num' => $size->SortID,
                'team_id' => $this->team->id
            ];
        }, $old_sizes);

        $last_id = $this->sqlsrv_conn->table('TblProductSizes')->max('SizeID');
        $this->bulk_insert(Size::class, $new_sizes, 'sizes_id_seq', $last_id + 1);
        echo "Finished ETL of sizes successfully!!!\n\n";
    }

    public function seed_nursery_locations()
    {
        $nusery_locations = NurseryLocation::insert([
            [
                'id' => 0,
                'team_id' => $this->team->id,
                'name' => 'Garden Gate Nursery East',
                'location_code' => 'GGE',
                'address' => '2761 W Sagemoor Rd',
                'city' => 'Pasco',
                'state' => 'WA',
                'zip' => '99301'
            ],
            [
                'id' => 1,
                'team_id' => $this->team->id,
                'name' => 'Garden Gate Nursery West',
                'location_code' => 'GGW',
                'address' => '10990 SE 362 Ave',
                'city' => 'Boring',
                'state' => 'OR',
                'zip' => '97009'
            ]
        ]);
        DB::statement("ALTER SEQUENCE nursery_locations_id_seq RESTART WITH 2");
    }

    public function do_ETL_blocks()
    {
        echo "Processing ETL of blocks...\n";
        $old_locations = $this->sqlsrv_conn->table('TblLocations')->get()->toArray();
        $last_location_id = $this->sqlsrv_conn->table('TblLocations')->max('LocationID');

        $old_block_locations = $this->sqlsrv_conn->table('TblBlockLocations')->get()->toArray();
        $last_block_location_id = $this->sqlsrv_conn->table('TblBlockLocations')->max('BlockID');

        $new_blocks = [];
        foreach($old_locations as $l) {
            array_push($new_blocks, [
                'id' => $l->LocationID,
                'team_id' => $this->team->id,
                'name' => $l->LocationName,
                'nursery_location_id' => 0, // Garden Gate Nursery East
                'has_places' => true,
            ]);
        }
        foreach($old_block_locations as $l) {
            array_push($new_blocks, [
                'id' => $l->BlockID + $last_location_id,
                'team_id' => $this->team->id,
                'name' => $l->BlockDescription,
                'nursery_location_id' => 1, // Garden Gate Nursery East
                'has_places' => false,
            ]);
        }

        $last_id = $last_block_location_id + $last_location_id + 1;
        $this->bulk_insert(Block::class, $new_blocks, 'blocks_id_seq', $last_id);
        echo "Finished ETL of blocks successfully!!!\n\n";
    }

    public function do_ETL_places()
    {
        echo "Processing ETL of places...\n";
        $old_location_rows = $this->sqlsrv_conn->table('TblLocationRows')->get()->toArray();
        $new_places = array_map(function($lr) {
            return [
                'id' => $lr->LocationRowID,
                'block_id' => $lr->LocationID,
                'row_number' => $lr->RowNumber,
                'plant_number' => $lr->PotNumber,
            ];
        }, $old_location_rows);

        $last_id = $this->sqlsrv_conn->table('TblLocationRows')->max('LocationRowID');
        $this->bulk_insert(Place::class, $new_places, 'places_id_seq', $last_id + 1);
        echo "Finished ETL of places successfully!!!\n\n";
    }

    public function do_ETL_products()
    {
        echo "Processing ETL of products...\n";
        $old_products = $this->sqlsrv_conn->table('TblProducts')->get()->toArray();
        $new_products = [];
        $new_plants = [];
        foreach ($old_products as $p) {
            array_push($new_products, [
                'id' => $p->ProductID,
                'team_id' => $this->team->id,
                'category_id' => $p->CategoryID,
                'name' => $p->CommonName,
                'type' => 'plant',
                'description' => $p->Description,
            ]);

            array_push($new_plants, [
                'product_id' => $p->ProductID,
                'scientific_name' => $p->ScientificName,
                'common_name' => $p->CommonName,
                'zone' => $p->Zone,
                'height' => $p->Height,
                'spread' => $p->Spread,
                'bloom_color' => $p->Bloom,
                'fall_color' => $p->FallColor,
                'growth_rate' => $p->GrowthRate,
            ]);
        }

        $last_id = $this->sqlsrv_conn->table('TblProducts')->max('ProductID');
        $this->bulk_insert(Product::class, $new_products, 'products_id_seq', $last_id + 1);
        $this->bulk_insert(Plant::class, $new_plants);
        echo "Finished ETL of products successfully!!!\n\n";
    }

    public function do_ETL_customers()
    {
        echo "Processing ETL of customers...\n";
        $old_customers = $this->sqlsrv_conn->table('TblCustomers')->get()->toArray();
        $new_customers = array_map(function($c) {
            return [
                'id' => $c->CustomerID,
                'name' => $c->CompanyName,
                'address' => $c->Address,
                'city' => $c->City,
                'state' => $c->State,
                'zip' => $c->Zip,
                'mailing_same_as_primary' => $c->MailingAddressSameAsPrimary,
                'mailing_address' => $c->MailingAddress,
                'mailing_city' => $c->MailingCity,
                'mailing_state' => $c->MailingState,
                'mailing_zip' => $c->MailingZip,
                'notes' => $c->Notes,
                'is_taxable' => $c->IsRetail,
                'tax_percentage' => $c->TaxPercentage,
                'reseller_permit_on_file' => $c->ResellerPermitOnFile,
                'reseller_permit_expiration' => $c->ResellerPermitExpiration,
                'discount_percentage' => $c->DiscountOverride,
                'team_id' => $this->team->id,
                'customer_price_level_id' => $c->PriceLevelID,
            ];
        }, $old_customers);

        $last_id = $this->sqlsrv_conn->table('TblCustomers')->max('CustomerID');
        $this->bulk_insert(Customer::class, $new_customers, 'customers_id_seq', $last_id + 1);
        echo "Finished ETL of customers successfully!!!\n\n";
    }

    public function do_ETL_users()
    {
        echo "Processing ETL of users...\n";
        $old_users = $this->sqlsrv_conn->table('TblEmployees')->get()->toArray();
        $new_users = array_map(function($u) {
            return [
                'id' => $u->EmployeeID,
                'name' => $u->FirstName . ' ' . $u->LastName,
                'email' => $this->faker->unique()->safeEmail(),
                'password' => $u->Password,
            ];
        }, $old_users);

        $last_id = $this->sqlsrv_conn->table('TblEmployees')->max('EmployeeID');
        $this->bulk_insert(User::class, $new_users, 'users_id_seq', $last_id + 1);
        echo "Finished ETL of users successfully!!!\n\n";
    }

    public function do_ETL_vendors()
    {
        echo "Processing ETL of vendors...\n";
        $old_vendors = $this->sqlsrv_conn->table('TblSuppliers')->get()->toArray();
        $new_vendors = array_map(function($v) {
            return [
                'id' => $v->SupplierID,
                'team_id' => $this->team->id,
                'name' => $v->CompanyName,
                'vendor_code' => $v->SupplierCode,
                'address' => $v->Address,
                'city' => $v->City,
                'state' => $v->State,
                'zip' => $v->Zip,
                'mailing_same_as_primary' => $v->MailingAddressSameAsPrimary,
                'mailing_address' => $v->MailingAddress,
                'mailing_city' => $v->MailingCity,
                'mailing_state' => $v->MailingState,
                'mailing_zip' => $v->MailingZip,
                'notes' => $v->Notes,
                'use_for_block_transfers' => $v->UseForBlockInventoryTransfers,
            ];
        }, $old_vendors);

        $last_id = $this->sqlsrv_conn->table('TblSuppliers')->max('SupplierID');
        $this->bulk_insert(Vendor::class, $new_vendors, 'vendors_id_seq', $last_id + 1);
        echo "Finished ETL of vendors successfully!!!\n\n";
    }

    public function do_ETL_purchases()
    {
        echo "Processing ETL of purchases...\n";
        $old_purchases = $this->sqlsrv_conn->table('TblOrders')->get()->toArray();
        $new_purchases = array_map(function($p) {
            return [
                'id' => $p->OrderID,
                'date' => $p->OrderDate,
                'vendor_id' => $p->SupplierID,
                'user_id' => $p->EmployeeID,
                'team_id' => $this->team->id,
            ];
        }, $old_purchases);

        $last_id = $this->sqlsrv_conn->table('TblOrders')->max('OrderID');
        $this->bulk_insert(Purchase::class, $new_purchases, 'purchases_id_seq', $last_id + 1);
        echo "Finished ETL of purchases successfully!!!\n\n";
    }

    public function do_ETL_purchases_items()
    {
        echo "Processing ETL of purchases_items...\n";
        $old_purchases_items = $this->sqlsrv_conn->table('TblOrdersItems')->get()->toArray();
        $new_purchases_items = array_map(function($pi) {
            return [
                'id' => $pi->OrderItemID,
                'purchase_id' => $pi->OrderID,
                'product_id' => $pi->ProductID,
                'size_id' => $pi->SizeID,
                'unit_price' => $pi->UnitPrice,
                'quantity_ordered' => $pi->QuantityOrdered,
                'quantity_confirmed' => $pi->QuantityConfirmed,
                'received' => $pi->Received,
                'printed' => $pi->Printed,
            ];
        }, $old_purchases_items);

        $last_id = $this->sqlsrv_conn->table('TblOrdersItems')->max('OrderItemID');
        $this->bulk_insert(PurchaseItem::class, $new_purchases_items, 'purchase_items_id_seq', $last_id + 1);
        echo "Finished ETL of purchases_items successfully!!!\n\n";
    }

    public function do_ETL_prices()
    {
        echo "Processing ETL of prices...\n";
        $old_categories_prices = $this->sqlsrv_conn->table('TblCategoriesPrices')->get()->toArray();
        $old_prices = $this->sqlsrv_conn->table('TblPrices')->get()->toArray();

        $new_prices = [];
        foreach($old_categories_prices as $cp) {
            array_push($new_prices, [
                'product_id' => null,
                'category_id' => $cp->CategoryID,
                'size_id' => $cp->SizeID,
                'unit_price' => $cp->UnitPrice,
            ]);
        }
        foreach($old_prices as $op) {
            array_push($new_prices, [
                'product_id' => $op->ProductID,
                'category_id' => null,
                'size_id' => $op->SizeID,
                'unit_price' => $op->UnitPrice,
            ]);
        }

        $this->bulk_insert(Price::class, $new_prices);
        echo "Finished ETL of prices successfully!!!\n\n";
    }

    public function do_ETL_shipping_methods()
    {
        echo "Processing ETL of shipping_methods...\n";
        $old_shipping_methods = $this->sqlsrv_conn->table('TblShippingMethods')->get()->toArray();
        $new_shipping_methods = array_map(function($sm) {
            return [
                'id' => $sm->ShippingMethodID,
                'name' => $sm->Description,
                'description' => $sm->Description,
            ];
        }, $old_shipping_methods);

        $last_id = $this->sqlsrv_conn->table('TblShippingMethods')->max('ShippingMethodID');
        $this->bulk_insert(ShippingMethod::class, $new_shipping_methods, 'shipping_methods_id_seq', $last_id + 1);
        echo "Finished ETL of shipping_methods successfully!!!\n\n";
    }

    public function do_ETL_customer_price_levels()
    {
        echo "Processing ETL of customer_price_levels...\n";
        $old_customer_price_levels = $this->sqlsrv_conn->table('TblCustomerPriceLevels')->get()->toArray();
        $new_customer_price_levels = array_map(function($cpl) {
            return [
                'id' => $cpl->PriceLevelID,
                'team_id' => $this->team->id,
                'name' => $cpl->Description,
                'description' => $cpl->Description,
                'percentage_more' => $cpl->Percentage,
            ];
        }, $old_customer_price_levels);

        $last_id = $this->sqlsrv_conn->table('TblCustomerPriceLevels')->max('PriceLevelID');
        $this->bulk_insert(CustomerPriceLevel::class, $new_customer_price_levels, 'customer_price_levels_id_seq', $last_id + 1);
        echo "Finished ETL of customer_price_levels successfully!!!\n\n";
    }

    public function do_ETL_orders()
    {
        echo "Processing ETL of orders...\n";
        $old_orders = $this->sqlsrv_conn->table('TblCustomerOrders')->get()->toArray();
        $new_orders= array_map(function($o) {
            return [
                'id' => $o->CustomerOrderID,
                'customer_id' => $o->CustomerID,
                'team_id' => $this->team->id,
                'contact_id' => null, // $o->ContactID,
                'date' => $o->OrderDate,
                'from_quote_id' => null, // $o->FromQuoteID,
                'shipping_method_id' => $o->ShippingMethodID,
                'shipping_amount' => $o->ShippingAmount,
                'warranty_percentage' => $o->WarrantyPercentage,
                'warranty_amount' => $o->WarrantyAmount,
                'total_discounts' => $o->TotalDiscounts,
                'tax_percentage' => $o->TaxPercentage,
                'tax_amount' => $o->TaxAmount,
                'total_after_discount_and_warranty' => $o->TotalAmount,
                'total' => $o->TotalAmountBeforeDiscount,
                'grand_total' => $o->GrandTotal,
                'is_taxable' => $o->IsRetailSale,
                'completed' => $o->OrderCompleted,
                'is_quote' => $o->IsQuote,
                'quote_expires' => $o->QuoteExpires,
                'hold_inventory' => $o->HoldInventory,
                'notes' => $o->JobDescription,
                'added_to_qb' => $o->QBAdded,
                'qb_id' => $o->QBID,
                'payment_status_id' => null,
                'delivery_status_id' => null,
            ];
        }, $old_orders);

        $last_id = $this->sqlsrv_conn->table('TblCustomerOrders')->max('CustomerOrderID');
        $this->bulk_insert(Order::class, $new_orders, 'orders_id_seq', $last_id + 1);
        echo "Finished ETL of orders successfully!!!\n\n";
    }

    public function do_ETL_order_items()
    {
        echo "Processing ETL of order_items...\n";
        $old_order_items = $this->sqlsrv_conn->table('TblCustomerOrdersItems')->get()->toArray();
        $new_order_items = array_map(function($oi) {
            return [
                'id' => $oi->CustomerOrderItemID,
                'order_id' => $oi->CustomerOrderID,
                'product_id' => $oi->ProductID,
                'size_id' => $oi->SizeID,
                'quantity' => $oi->Quantity,
                'original_quantity' => 0,
                'unit_price' => $oi->UnitPrice,
                'no_discount' => $oi->NoAutoDiscount,
                'quantity_fulfilled' => $oi->Quantity,
            ];
        }, $old_order_items);

        $this->bulk_insert(OrderItem::class, $new_order_items);
        echo "Finished ETL of order_items successfully!!!\n\n";
    }

    public function do_ETL_order_discounts()
    {
        echo "Processing ETL of order_discounts...\n";
        $old_order_discounts = $this->sqlsrv_conn->table('TblCustomerOrdersDiscounts')->get()->toArray();
        $new_order_discounts = array_map(function($od) {
            return [
                'order_id' => $od->CustomerOrderID,
                'description' => $od->Description,
                'discount_amount' => $od->DollarAmount,
                // 'discount_percentage' => $od->,
                // 'discount_applied' => $od->,
            ];
        }, $old_order_discounts);

        $this->bulk_insert(OrderDiscount::class, $new_order_discounts);
        echo "Finished ETL of order_discounts successfully!!!\n\n";
    }

    public function do_ETL_inventories()
    {
        echo "Processing ETL of inventories...\n";

        $this->do_ETL_individual_inventory();
        $this->do_ETL_block_inventory();

        echo "Finished ETL of inventories successfully!!!\n\n";
    }

    public function do_ETL_individual_inventory()
    {
        echo "Processing ETL of individual inventories...\n";
        $old_individual_inventories = $this->sqlsrv_conn->table('TblInventory')->get()->toArray();
        $last_ii_id = $this->sqlsrv_conn->table('TblInventory')->max('InventoryID');

        $old_individual_archive_inventories = $this->sqlsrv_conn
            ->table('TblInventoryArchive')
            ->whereNotIn('OrderItemID', [465, 4637])
            ->get()
            ->toArray();
        $last_ii_archive_id = $this->sqlsrv_conn->table('TblInventoryArchive')->max('InventoryID');

        $new_inventories = [];
        foreach ($old_individual_inventories as $ii) {
            array_push($new_inventories, [
                'id' => $ii->InventoryID,
                'team_id' => $this->team->id,
                'purchase_item_id' => $ii->OrderItemID,
                'product_id' => $ii->ProductID,
                'original_size_id' => $ii->OriginalSizeID,
                'size_id' => $ii->SizeID,
                'ready_date' => $ii->DateAdded,
                'quantity' => 1,
                'type' => 'individual',
                'block_id' => null,
                'place_id' => $ii->LocationRowID,
                'nursery_location_id' => 0, //Garden Gate East
            ]);
        }

        foreach ($old_individual_archive_inventories as $iia) {
            array_push($new_inventories, [
                'id' => $iia->InventoryID,
                'team_id' => $this->team->id,
                'purchase_item_id' => $iia->OrderItemID,
                'product_id' => $iia->ProductID,
                'original_size_id' => $iia->OriginalSizeID,
                'size_id' => $iia->SizeID,
                'ready_date' => $iia->DateAdded,
                'quantity' => 1,
                'type' => 'individual',
                'block_id' => null,
                'place_id' => null, // $iia->LocationRowID,
                'nursery_location_id' => 0, //Garden Gate East
            ]);
        }

        $this->bulk_insert(Inventory::class, $new_inventories, 'inventories_id_seq', max($last_ii_id, $last_ii_archive_id) + 1);
        echo "Finished ETL of individual inventories successfully!!!\n\n";
    }

    public function do_ETL_block_inventory()
    {
        echo "Processing ETL of block inventories...\n";
        $last_ii_id = $this->sqlsrv_conn->table('TblInventory')->max('InventoryID');
        $last_ii_archive_id = $this->sqlsrv_conn->table('TblInventoryArchive')->max('InventoryID');
        $last_bi_id = $this->sqlsrv_conn->table('TblBlockInventory')->max('BlockInventoryID');
        $last_location_id = $this->sqlsrv_conn->table('TblLocations')->max('LocationID');

        $last_inventory_id = max($last_ii_id, $last_ii_archive_id);
        $old_block_inventories = $this->sqlsrv_conn->table('TblBlockInventory')->get()->toArray();
        $purchase_item_ids = array();
        $new_inventories = array();

        foreach($old_block_inventories as $bi) {
            $user_id = $bi->EmployeeID;
            $vendor_id = $bi->SupplierID;

            if (!array_key_exists($user_id, $purchase_item_ids)) {
                $purchase_item_ids[$user_id] = array();
            }
            if (!array_key_exists($vendor_id, $purchase_item_ids[$user_id])) {
                $purchase = Purchase::create([
                    'date' => $bi->DateAdded,
                    'vendor_id' => $vendor_id,
                    'user_id' => $user_id,
                    'team_id' => $this->team->id,
                    'order_number' => 0 // okay with random number
                ]);

                $purchase_item = PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $bi->ProductID,
                    'size_id' => $bi->SizeID,
                    'unit_price' => 0,
                    'quantity_ordered' => 0,
                    'quantity_confirmed' => 0,
                    'received' => 1,
                    'printed' => 0,
                ]);

                $purchase_item_ids[$user_id][$vendor_id] = $purchase_item->id;
            }

            array_push($new_inventories, [
                'id' => $bi->BlockInventoryID + $last_inventory_id,
                'team_id' => $this->team->id,
                'purchase_item_id' => $purchase_item_ids[$user_id][$vendor_id],
                'product_id' => $bi->ProductID,
                'original_size_id' => $bi->SizeID,
                'size_id' => $bi->SizeID,
                'ready_date' => $bi->DateAdded,
                'quantity' => $bi->InventoryCount,
                'type' => 'group',
                'block_id' => $bi->BlockID + $last_location_id,
                'place_id' => null,
                'nursery_location_id' => 1, //Garden Gate West
            ]);
        }

        $this->bulk_insert(Inventory::class, $new_inventories, 'inventories_id_seq', $last_inventory_id + $last_bi_id + 1);
        echo "Finished ETL of block inventories successfully!!!\n\n";
    }

    public function do_ETL_inventory_archive()
    {
        echo "Processing ETL of inventory_archive...\n";

        $this->do_ETL_individual_inventory_archive();
        $this->do_ETL_block_inventory_archive();

        echo "Finished ETL of inventory_archive successfully!!!\n\n";
    }

    public function do_ETL_individual_inventory_archive()
    {
        echo "Processing ETL of individual inventory_archive...\n";

        $old_inventory_archive = $this->sqlsrv_conn->table('TblInventoryArchive')->get()->toArray();
        $new_inventory_archive = array_map(function($ia) {
            return [
                'order_item_id' => $ia->OrderItemID,
                'inventory_id' => $ia->InventoryID,
                'quantity_removed' => 0,
                'reason_removed' => $ia->ReasonRemovedFromInventory,
                'was_adjustment' => $ia->WasInventoryAdjustment,
                'removed_by_id' => $ia->RemovedByEmployeeID,
                'created_at' => $ia->DateRemoved,
            ];
        }, array_slice($old_inventory_archive, 0, 10));

        $this->bulk_insert(InventoryArchive::class, $new_inventory_archive);
        echo "Finished ETL of individual inventory_archive successfully!!!\n\n";
    }

    public function do_ETL_block_inventory_archive()
    {
        echo "Processing ETL of block inventory_archive...\n";
        $last_ii_id = $this->sqlsrv_conn->table('TblInventory')->max('InventoryID');
        $last_ii_archive_id = $this->sqlsrv_conn->table('TblInventoryArchive')->max('InventoryID');
        $last_inventory_id = max($last_ii_id, $last_ii_archive_id);

        $old_block_inventory_archive = $this->sqlsrv_conn->table('TblBlockInventoryArchive')->get()->toArray();
        $new_block_inventory_archive = array_map(function($bia) use ($last_inventory_id) {
            return [
                'order_item_id' => 1, // $bia->CustomerOrderItemID,
                'inventory_id' => $bia->BlockInventoryID + $last_inventory_id,
                'quantity_removed' => 0,
                'reason_removed' => $bia->Reason,
                'was_adjustment' => 0,
                'removed_by_id' => $bia->EmployeeID,
                'created_at' => $bia->DateRemoved,
            ];
        }, $old_block_inventory_archive);

        $this->bulk_insert(InventoryArchive::class, $new_block_inventory_archive);
        echo "Finished ETL of block inventory_archive successfully!!!\n\n";
    }
}
