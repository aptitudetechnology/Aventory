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
        Schema::create('codat_records', function (Blueprint $table) {
            $table->id();
            $table->uuid('company_id');
            $table->uuid('connection_id');
            $table->string('record_id')->nullable();
            $table->morphs('pushable');
            $table->uuid('push_id')->nullable();
            $table->enum('push_status', ['Pending', 'Success', 'Failed'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codat_records');
    }
};
