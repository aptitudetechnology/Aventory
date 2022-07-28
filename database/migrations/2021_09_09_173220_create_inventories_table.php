<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
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
            'inventories',
            function (Blueprint $table) {
                $table->id();

                $table->foreignId('team_id')
                    ->constrained()
                    ->cascadeOnDelete()->cascadeOnUpdate();

                $table->foreignId('purchase_item_id')
                    ->constrained()
                    ->cascadeOnDelete()->cascadeOnUpdate();

                $table->foreignId('product_id')
                    ->constrained()
                    ->cascadeOnDelete()->cascadeOnUpdate();

                $table->foreignId('original_size_id')
                    ->nullable()
                    ->constrained('sizes')->onDelete('set null')->cascadeOnUpdate();

                $table->foreignId('size_id')
                    ->nullable()
                    ->constrained()->onDelete('set null')->cascadeOnUpdate();

                $table->integer('quantity')->default(1);

                $table->enum('type', ['group', 'individual']);

                $table->foreignId('block_id')
                    ->nullable()
                    ->constrained()->onDelete('set null')->cascadeOnUpdate();

                $table->foreignId('place_id')
                    ->nullable()
                    ->constrained()->onDelete('set null')->cascadeOnUpdate();

                $table->date('ready_date')->useCurrent();

                $table->timestamps();
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
        Schema::dropIfExists('inventories');
        Schema::enableForeignKeyConstraints();
    }
}
