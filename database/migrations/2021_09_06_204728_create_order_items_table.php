<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('size_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->double('unit_price');
            $table->integer('quantity_ordered');
            $table->integer('quantity_confirmed');
            $table->boolean('received')->default(false);
            $table->boolean('printed')->default(false);
            $table->boolean('in_inventory')->default(false);
            $table->date('ready_date')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('order_items');
        Schema::enableForeignKeyConstraints();
    }
}
