<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->boolean('mailing_same_as_primary')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_state')->nullable();
            $table->string('mailing_zip')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_retail')->nullable();
            $table->boolean('hide_customer')->nullable();
            $table->boolean('no_auto_discount')->nullable();
            $table->decimal('tax_percentage', 9, 2)->nullable();
            $table->boolean('reseller_permit_on_file')->default(false);
            $table->date('reseller_permit_expiration')->nullable();
            $table->unsignedTinyInteger('discount_override')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
