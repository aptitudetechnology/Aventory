<?php

namespace Database\Seeders\Customers;

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

class GardenGateNurseryDataSeeder extends Seeder
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
        $this->freshDB();

        $this->migrateUsers();

        // Create Garden Gate Nursery team
        $this->team = $this->createGardenGateNurseryTeam();
        $this->createNurseryLocations();

        $this->migrateCategories();
        $this->migrateSizes();
        $this->migrateBlocks();
        $this->migratePlaces();
        $this->migrateProducts();
        $this->migratePrices();

        $this->migrateCustomerPriceLevels();
        $this->migrateCustomers();

        $this->migrateVendors();
        $this->migratePurchases();
        $this->migratePurchasesItems();
        $this->migrateShippingMethods();

        $this->migrateOrders();
        $this->migrateOrderItems();
        $this->migrateOrderDiscounts();

        $this->migrateInventories();
        $this->migrateInventoryArchive();
    }

    public function bulkInsert($model, $data, $id_seq_name = null, $id_seq_value = null)
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

    public function freshDB()
    {
        echo "Freshing the database...\n";
        Artisan::call('migrate:fresh');
        echo "Freshed the database successfully!\n";
    }

    public function createGardenGateNurseryTeam()
    {
        $init_user = User::factory()->create([
            'email' => 'teststuff@gmail.com'
        ]);

        return Team::factory()->create([
            'name' => 'Garden Gate Nursery',
            'user_id' => $init_user->id
        ]);
    }
    
    public function migrateCategories()
    {
        echo "Migrating categories...\n";
        $old_categories = $this->sqlsrv_conn->table('TblCategories')->get()->toArray();
        $new_categories = array_map(function($category) {
            return [
                'id' => $category->CategoryID,
                'name' => $category->Category,
                'team_id' => $this->team->id
            ];
        }, $old_categories);

        $last_id = $this->sqlsrv_conn->table('TblCategories')->max('CategoryID');
        $this->bulkInsert(Category::class, $new_categories, 'categories_id_seq', $last_id + 1);
        echo "Migrated categories successfully!!!\n\n";
    }

    public function migrateSizes()
    {
        echo "Migrating sizes...\n";
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
        $this->bulkInsert(Size::class, $new_sizes, 'sizes_id_seq', $last_id + 1);
        echo "Migrated sizes successfully!!!\n\n";
    }

    public function createNurseryLocations()
    {
        NurseryLocation::insert([
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

    public function migrateBlocks()
    {
        echo "Migrating blocks...\n";
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
        $this->bulkInsert(Block::class, $new_blocks, 'blocks_id_seq', $last_id);
        echo "Migrated blocks successfully!!!\n\n";
    }

    public function migratePlaces()
    {
        echo "Migrating places...\n";
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
        $this->bulkInsert(Place::class, $new_places, 'places_id_seq', $last_id + 1);
        echo "Migrated places successfully!!!\n\n";
    }

    public function migrateProducts()
    {
        echo "Migrating products...\n";
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
        $this->bulkInsert(Product::class, $new_products, 'products_id_seq', $last_id + 1);
        $this->bulkInsert(Plant::class, $new_plants);
        echo "Migrated products successfully!!!\n\n";
    }

    public function migrateCustomers()
    {
        echo "Migrating customers...\n";
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
        $this->bulkInsert(Customer::class, $new_customers, 'customers_id_seq', $last_id + 1);
        echo "Migrated customers successfully!!!\n\n";
    }

    public function migrateUsers()
    {
        echo "Migrating users...\n";
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
        $this->bulkInsert(User::class, $new_users, 'users_id_seq', $last_id + 1);
        echo "Migrated users successfully!!!\n\n";
    }

    public function migrateVendors()
    {
        echo "Migrating vendors...\n";
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
        $this->bulkInsert(Vendor::class, $new_vendors, 'vendors_id_seq', $last_id + 1);
        echo "Migrated vendors successfully!!!\n\n";
    }

    public function migratePurchases()
    {
        echo "Migrating purchases...\n";
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
        $this->bulkInsert(Purchase::class, $new_purchases, 'purchases_id_seq', $last_id + 1);
        echo "Migrated purchases successfully!!!\n\n";
    }

    public function migratePurchasesItems()
    {
        echo "Migrating purchases items...\n";
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
        $this->bulkInsert(PurchaseItem::class, $new_purchases_items, 'purchase_items_id_seq', $last_id + 1);
        echo "Migrated purchases items successfully!!!\n\n";
    }

    public function migratePrices()
    {
        echo "Migrating prices...\n";
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

        $this->bulkInsert(Price::class, $new_prices);
        echo "Migrated prices successfully!!!\n\n";
    }

    public function migrateShippingMethods()
    {
        echo "Migrating shipping methods...\n";
        $old_shipping_methods = $this->sqlsrv_conn->table('TblShippingMethods')->get()->toArray();
        $new_shipping_methods = array_map(function($sm) {
            return [
                'id' => $sm->ShippingMethodID,
                'name' => $sm->Description,
                'description' => $sm->Description,
            ];
        }, $old_shipping_methods);

        $last_id = $this->sqlsrv_conn->table('TblShippingMethods')->max('ShippingMethodID');
        $this->bulkInsert(ShippingMethod::class, $new_shipping_methods, 'shipping_methods_id_seq', $last_id + 1);
        echo "Migrated shipping methods successfully!!!\n\n";
    }

    public function migrateCustomerPriceLevels()
    {
        echo "Migrating customer price levels...\n";
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
        $this->bulkInsert(CustomerPriceLevel::class, $new_customer_price_levels, 'customer_price_levels_id_seq', $last_id + 1);
        echo "Migrated customer price levels successfully!!!\n\n";
    }

    public function migrateOrders()
    {
        echo "Migrating orders...\n";
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
        $this->bulkInsert(Order::class, $new_orders, 'orders_id_seq', $last_id + 1);
        echo "Migrated orders successfully!!!\n\n";
    }

    public function migrateOrderItems()
    {
        echo "Migrating order items...\n";
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

        $this->bulkInsert(OrderItem::class, $new_order_items);
        echo "Migrated order items successfully!!!\n\n";
    }

    public function migrateOrderDiscounts()
    {
        echo "Migrating order discounts...\n";
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

        $this->bulkInsert(OrderDiscount::class, $new_order_discounts);
        echo "Migrated order discounts successfully!!!\n\n";
    }

    public function migrateInventories()
    {
        echo "Migrating inventories...\n";

        $this->migrateIndividualInventory();
        $this->migrateBlockInventory();

        echo "Migrated inventories successfully!!!\n\n";
    }

    public function migrateIndividualInventory()
    {
        echo "Migrating individual inventories...\n";
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
                'created_at' => $ii->DateAdded,
                'updated_at' => $ii->LastInventoryDate,
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
                'created_at' => $iia->DateAdded,
                'updated_at' => $iia->LastInventoryDate,
                'quantity' => 1,
                'type' => 'individual',
                'block_id' => null,
                'place_id' => null, // $iia->LocationRowID,
                'nursery_location_id' => 0, //Garden Gate East
            ]);
        }

        $this->bulkInsert(Inventory::class, $new_inventories, 'inventories_id_seq', max($last_ii_id, $last_ii_archive_id) + 1);
        echo "Migrated individual inventories successfully!!!\n\n";
    }

    public function migrateBlockInventory()
    {
        echo "Migrating block inventories...\n";
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

        $this->bulkInsert(Inventory::class, $new_inventories, 'inventories_id_seq', $last_inventory_id + $last_bi_id + 1);
        echo "Migrated block inventories successfully!!!\n\n";
    }

    public function migrateInventoryArchive()
    {
        echo "Migrating inventory archive...\n";

        $this->migrateIndividualInventoryArchive();
        $this->migrateBlockInventoryArchive();

        echo "Migrated inventory archive successfully!!!\n\n";
    }

    public function migrateIndividualInventoryArchive()
    {
        echo "Migrating individual inventory archive...\n";

        $old_inventory_archive = $this->sqlsrv_conn->table('TblInventoryArchive')
            ->whereNotIn('OrderItemID', [465, 4637])
            ->get()
            ->toArray();

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
        }, $old_inventory_archive);

        $this->bulkInsert(InventoryArchive::class, $new_inventory_archive);
        echo "Migrated individual inventory archive successfully!!!\n\n";
    }

    public function migrateBlockInventoryArchive()
    {
        echo "Migrating block inventory archive...\n";
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

        $this->bulkInsert(InventoryArchive::class, $new_block_inventory_archive);
        echo "Migrated block inventory archive successfully!!!\n\n";
    }
}
