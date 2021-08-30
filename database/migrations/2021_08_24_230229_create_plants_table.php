<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate()->unique();
            $table->string('scientific_name');
            $table->string('common_name');
            $table->string('zone')->nullable();
            $table->integer('height')->nullable();
            $table->integer('spread')->nullable();
            $table->string('bloom_color', 50)->nullable();
            $table->string('fall_color', 50)->nullable();
            $table->string('growth_rate', 50)->nullable();
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
        Schema::dropIfExists('plants');
    }
}
