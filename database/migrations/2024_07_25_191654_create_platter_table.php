<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('platter', function (Blueprint $table) {
            $table->increments('platter_id');
            $table->string('platter_title',200);
            $table->string('platter_short_title',100);
            $table->text('platter_description')->nullable();
            $table->string('platter_image',100)->nullable();
            $table->decimal('platter_price',8,2);

            $table->tinyInteger('status')->default(1);
            $table->integer('creator');
            $table->integer('modifier');
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modified_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platter');
    }
};
