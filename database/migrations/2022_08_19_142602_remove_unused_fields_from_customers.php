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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('codat_push_status');
            $table->dropColumn('codat_record_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->enum('codat_push_status', ['Pending', 'Success', 'Failed'])->nullable()->after('codat_record_id');
            $table->uuid('codat_record_id')->nullable()->after('id');
        });
    }
};
