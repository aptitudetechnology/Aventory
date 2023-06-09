<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create(
            'places', function (Blueprint $table) {
                $table->id();
                $table->foreignId('block_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->integer('row_number');
                $table->integer('plant_number');
                $table->timestamps();

                $table->unique(['block_id', 'row_number', 'plant_number']);
            }
        );

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
        Schema::dropIfExists('places');
        Schema::enableForeignKeyConstraints();
    }
}
