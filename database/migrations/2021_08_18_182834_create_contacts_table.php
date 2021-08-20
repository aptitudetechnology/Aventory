<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null')->cascadeOnUpdate();
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone_1', 20)->nullable();
            $table->string('phone_2', 20)->nullable();
            $table->string('cell_phone', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('notes', 8000)->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
