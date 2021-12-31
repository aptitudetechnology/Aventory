<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusesColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('payment_status_id')->nullable()->after('customer_id')
                ->constrained('payment_statuses')->onDelete('set null')->onUpdate('cascade');

            $table->foreignId('delivery_status_id')->nullable()->after('payment_status_id')
                ->constrained('delivery_statuses')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['payment_status_id']);
            $table->dropForeign(['delivery_status_id']);
            $table->dropColumn('payment_status_id');
            $table->dropColumn('delivery_status_id');
        });
    }
}
