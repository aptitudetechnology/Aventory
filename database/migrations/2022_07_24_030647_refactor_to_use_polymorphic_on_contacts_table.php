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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['vendor_id']);
            $table->dropColumn(['customer_id', 'vendor_id']);

            $table->unsignedInteger("contactable_id")->after('team_id');
            $table->string("contactable_type")->after('contactable_id');
            $table->index(["contactable_id", "contactable_type"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropMorphs('contactable');
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null')->cascadeOnUpdate();
            $table->foreignId('vendor_id')->nullable()->after('customer_id')->constrained()->onDelete('set null')->cascadeOnUpdate();
        });
    }
};
