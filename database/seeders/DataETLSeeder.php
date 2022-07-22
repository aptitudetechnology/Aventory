<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use App\Models\Category;
use App\Models\Size;
use App\Models\Team;

class DataETLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fresh_db();

        $team = $this->create_team();
        $sqlsrv_conn = DB::connection('sqlsrv');

        // ETL of categories
        $old_categories = $sqlsrv_conn->table('TblCategories')->get()->toArray();
        $new_categories = array_map(function($category) use ($team) {
            return [
                'id' => $category->CategoryID,
                'name' => $category->Category,
                'team_id' => $team->id
            ];
        }, $old_categories);

        Category::insert($new_categories);

        // ETL of sizes
        $old_sizes = $sqlsrv_conn->table('TblProductSizes')->get()->toArray();
        $new_sizes = array_map(function($size) use ($team) {
            return [
                'id' => $size->SizeID,
                'name' => $size->Description,
                'next_size_id' => $size->NextSizeID,
                'sort_num' => $size->SortID,
                'team_id' => $team->id
            ];
        }, $old_sizes);

        Size::insert($new_sizes);
    }

    public function fresh_db()
    {
        echo "Fresh the database...\n";
        Artisan::call('migrate:fresh');
        echo "Freshed the database successfully!\n";
    }

    public function create_team()
    {
        return Team::factory()->create();
    }
}
