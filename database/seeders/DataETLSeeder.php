<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use App\Models\Category;
use App\Models\Size;
use App\Models\Team;
use App\Models\NurseryLocation;
use App\Models\Product;
use App\Models\Plant;
use App\Models\Order;
use App\Models\OrderItem;

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
        $this->sqlsrv_conn = DB::connection('sqlsrv');
    }

    public function run()
    {
        $this->fresh_db();

        // Create Garden Gate Nursery team
        $this->team = $this->create_team();

        $this->do_ETL_categories();
        $this->do_ETL_sizes();
        $this->do_ETL_locations();
        $this->do_ETL_products();
    }

    public function fresh_db()
    {
        echo "Fresh the database...\n";
        Artisan::call('migrate:fresh');
        echo "Freshed the database successfully!\n";
    }

    public function create_team()
    {
        return Team::factory()->create([
            'name' => 'Garden Gate Nursery'
        ]);
    }
    
    public function do_ETL_categories()
    {
        $old_categories = $this->sqlsrv_conn->table('TblCategories')->get()->toArray();
        $new_categories = array_map(function($category) {
            return [
                'id' => $category->CategoryID,
                'name' => $category->Category,
                'team_id' => $this->team->id
            ];
        }, $old_categories);

        Category::insert($new_categories);
    }

    public function do_ETL_sizes()
    {
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

        Size::insert($new_sizes);
    }

    public function do_ETL_locations()
    {
        $old_locations = $this->sqlsrv_conn->table('TblLocations')->get()->toArray();
        $new_locations = array_map(function($l) {
            return [
                'id' => $l->LocationID,
                'name' => $l->LocationName,
                'team_id' => $this->team->id
            ];
        }, $old_locations);

        NurseryLocation::insert($new_locations);
    }

    public function do_ETL_products()
    {
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

        Product::insert($new_products);
        Plant::insert($new_plants);
    }
}
