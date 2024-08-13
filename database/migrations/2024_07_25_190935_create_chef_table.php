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
        Schema::create('chef', function (Blueprint $table) {
            $table->increments('chef_id');
            $table->string('chef_name',150);
            $table->string('chef_designation',150);
            $table->text('chef_description')->nullable();
            $table->string('chef_image',100)->nullable();
            $table->integer('position')->default(0);

            $table->string('twitter_link',100)->nullable();
            $table->string('facebook_link',100)->nullable();
            $table->string('instagram_link',100)->nullable();
            $table->string('linkedin_link',100)->nullable();

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
        Schema::dropIfExists('chef');
    }
};
