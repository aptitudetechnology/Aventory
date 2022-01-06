<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_discounts', function (Blueprint $table) {
            $table->renameColumn('amount', 'discount_amount');
            $table->renameColumn('percent', 'discount_percentage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_discounts', function (Blueprint $table) {
            $table->renameColumn('discount_amount', 'amount');
            $table->renameColumn('discount_percentage', 'percent');
        });
    }
}
