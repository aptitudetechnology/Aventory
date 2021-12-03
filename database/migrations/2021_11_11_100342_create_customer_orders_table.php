<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onUpdate('cascade');
            $table->foreignId('team_member_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_id');
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');
            $table->foreignId('from_quote_id')->nullable()->constrained('sales')->onDelete('set null')->cascadeOnUpdate();
            $table->foreignId('shipping_method_id')->nullable()->constrained('shipping_methods')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('shipping_amount', 10, 2)->nullable();
            $table->decimal('warranty_percentage', 9, 4)->nullable();
            $table->decimal('warranty_amount', 9, 2)->nullable();
            $table->decimal('total_discounts', 9, 2)->default(0);
            $table->decimal('tax_percentage', 9, 4)->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('total_amount_before_discount', 9, 2)->default(0);
            $table->decimal('grand_total', 9, 2)->default(0);
            $table->boolean('is_taxable')->default(true);
            $table->boolean('completed')->default(false);
            $table->boolean('is_quote')->default(false);
            $table->date('quote_expires')->nullable();
            $table->boolean('hold_inventory')->default(false);
            $table->text('notes')->nullable();
            $table->boolean('added_to_qb')->default(false);
            $table->string('qb_id')->nullable();


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
        Schema::dropIfExists('orders');
    }
}
