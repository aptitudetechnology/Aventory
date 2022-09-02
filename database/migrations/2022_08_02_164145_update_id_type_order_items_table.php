<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_archive', function (Blueprint $table) {
            $table->dropForeign('inventory_archive_order_item_id_foreign');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->id();
        });

        Schema::table('inventory_archive', function (Blueprint $table) {
            $table->foreign('order_item_id')
                ->references('id')
                ->on('order_items')
                ->onDelete('cascade');
        });
    }
};
