<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('vendor_code', 50)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip', 20)->nullable();
            $table->boolean('mailing_same_as_primary')->default(true);
            $table->string('mailing_address')->nullable();
            $table->string('mailing_city', 50)->nullable();
            $table->string('mailing_state', 50)->nullable();
            $table->string('mailing_zip', 20)->nullable();
            $table->string('notes', 8000)->nullable();
            $table->boolean('use_for_block_transfers')->default(false);
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
        Schema::dropIfExists('vendors');
    }
}
